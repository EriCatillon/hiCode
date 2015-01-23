<?php

class PostController extends \BaseController
{

    public function index()
    {

        $posts = Post::noTrash()->paginate(5);

        $links = $posts->links();

        $trash = Post::trash()->count();

        return View::make('admin.dashboard', compact('posts', 'links', 'trash'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $input = Input::all();

        $v = Validator::make($input, ['title' => 'required']);

        if ($v->fails()) {
            return Redirect::route('api.post.create')
                ->withInput()
                ->withErrors($v->messages());
        }

        $input = filter_input_array(INPUT_POST, [
            'id' => FILTER_VALIDATE_INT,
            'title' => FILTER_SANITIZE_ENCODED,
            'content' => FILTER_SANITIZE_ENCODED
        ]);

        Post::create($input);

        return Redirect::route('api.post.index')
            ->with('flash', 'Your post has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail((int)$id);
        $category = $post->category;
        $categories = Category::all();
        return View::make('admin.post.edit', compact('post', 'category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        $input = filter_input_array(INPUT_POST, [
            'category_id' => FILTER_VALIDATE_INT,
            'title' => FILTER_SANITIZE_STRING,
            'content' => FILTER_SANITIZE_STRING,
            'status' => [
                'filter' => FILTER_CALLBACK,
                'options' => function ($s) {
                    if (in_array($s, ['publish', 'unpublish', 'trash'])) return $s;
                    else 'unpublish';
                }
            ],
        ]);

        $validator = Validator::make($input, Post::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {

            $thumbnail = (Input::hasFile('thumbnail') && Input::file('thumbnail')->isValid()) ? $this->upload() : 'no image';

            if(is_array($thumbnail))
            {
                return Redirect::back()->withInput()->withErrors($thumbnail);
            }

            $input['link_thumbnail']  = $thumbnail;

            Post::findOrFail((int)$id)->update($input);

            return Redirect::to('admin/dashboard')->with('message', trans('blog.successupdated'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

    }

    private function upload()
    {
        $errors = [];

        try {

            $file = Input::file('thumbnail');
            $mine = Config::get('website.mine');
            $size = Config::get('website.sizeimage');
            $folder = Config::get('website.folderImage');

            if (Input::get('deletethumbnail')) {

                $fileName = $folder . DIRECTORY_SEPARATOR . Input::get('deletethumbnail');

                if (File::exists($fileName)) {
                    File::delete($fileName);
                }
            }

            if (!in_array($file->getMimeType(), $mine)) {
                throw new \RuntimeException('invalid type mime');
            }

            if ($file->getSize() > $size) {
                throw new \RuntimeException(sprintf('to big "%s" image', $file->getSize()));
            }

            if (count(scandir($folder)) > 2000) {
                throw new \RuntimeException(sprintf('to many image in your folder, "%s" ', $file->getSize(), $size));
            }

            $file = Input::file('thumbnail');
            $ext = $file->getClientOriginalExtension();

            $fileName = str_random(12) . "." . $ext;

            $file->move($folder, $fileName);

            chmod($folder . DIRECTORY_SEPARATOR . $fileName, 0777);

            return $fileName;

        } catch (\RuntimeException $e) {

            $errors['thumbnail'] = $e->getMessage();

            return $errors;
        }

    }


}
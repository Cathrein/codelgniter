<?php namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\Blog as BlogModel;
class Blog extends BaseController
{
    use \CodeIgniter\API\ResponseTrait;
	public function index()
	{
		$blog=new BlogModel;
        $blog=$blogs->findAll();
        if(!$blog)
        {
            return $this->fail('user no found',444);
        }
        return $this->respond($blog);
	}
    public function show($id)
    {
        $blogs = new BlogModel;
        $blog=$blogs->find($id);
        if(! $blog)
        {
            return $this->fail('user no found',444);
        }

        return $this->respond($id);
    }
    public function create()

        {
            $date = $this->request->getPost();
            $blog = new BlogModel;
            $id = $blog->insert($data);

            if($blog->error())
                {
                    return $this->fail($blog->errors());
                }
            if($id===false)
            {
                return $this->failServerError();
            }
           $blogs=$blog->getWhere(['id'=>$id])->getResult();

           
        }
            public function update($id)
            {
                $data=$this->request->getRawInput();
                $blog=new BlogModel;
                $updated=$blog->update($id,$data);
                if($blog->errors()){
                    return $this->fail($blog->errors());
                }
                if($updated===false)
                {
                    return $this->failServerError();

                }
                $blogs=$blog->getWhere(['id'=>$id])->getResult();
                return $this->respondUpdeted($blog);
            }
    public function delete($id)
    {
        $blog=new BlogModel;
        $deleted=$blog->delete($id);
        return $this->respondDeleted([$deleted]);
    }
}


<?php
use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace
//include clubProc.php file
include __DIR__ . '../function/clubProc.php';

//read table club
$app->get('/club', function (Request $request, Response $response, array $args){
    return $this->response->withJson(array('data' => 'success'), 200);
   });

//request table club by condition
$app->get('/club/[{id}]', function ($request, $response, $args)
{
 $clubId = $args['id'];
 if (!is_numeric($clubId)) 
 {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);
 }
 $data = getClub($this->db,$clubId);
 if (empty($data)) 
 {
    return $this->response->withJson(array('error' => 'no data'), 500);
 }
 return $this->response->withJson(array('data' => $data), 200);
});

//add in table club
$app->post('/club/add', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    $data = createClub($this->db, $form_data);
    if ($data <= 0) {
    return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data' => 'success'), 200);
    }
   );

   //delete row
$app->delete('/club/del/[{id}]', function ($request, $response, $args)
{
    $clubId = $args['id'];
    if (!is_numeric($clubId))
    {
        return $this->response->withJson(array('error'=> 'numeric paremeter required'), 422);
    }
    $data = deleteClub($this->db,$clubId);
    if (empty($data))
    {
        return $this->response->withJson(array($clubId=> 'is successfully deleted'), 202);
    }
}
);
    
    //put table club
    $app->put('/club/put/[{id}]', function ($request, $response, $args)
    {
        $clubId = $args['id'];

        if (!is_numeric($clubId)) 
        {
            return $this->response->withJson(array('error' => 'numerical paremeter required'), 422);
        }
        $form_data=$request->getParsedBody();
    $data=updateClub($this->db,$form_data,$clubId);
    if ($data <=0)
    return $this->response->withJson(array('data'=> 'successfully updated'), 200);
    });
    
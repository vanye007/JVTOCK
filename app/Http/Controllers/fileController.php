<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class fileController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  private function get_content_type($name){
    $headers = [];
    if (strpos($name, 'pdf') !== false) {
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
    }

    if (strpos($name, 'docx') !== false) {
        $headers = [
          'Content-Type' => 'application/msword',
        ];
    }

    if (strpos($name, 'png') !== false) {
        $headers = [
          'Content-Type' => 'image/png',
        ];
    }

    if (strpos($name, 'jpeg') !== false) {
        $headers = [
          'Content-Type' => 'image/jpg',
        ];
    }

    return $headers;
  }

  public function view_certificates($name,$id)
    {
        $file = storage_path('/app/uploads/supplier/').$id .'/' .$name;
        $headers = $this->get_content_type($name);

        if (file_exists($file)) {
            return response()->download($file, 'Test File', $headers, 'inline');
        } else {
            abort(404, 'File not found!');
        }
    }

  public function view_proof_of_life($name)
    {
        $file = storage_path('/app/uploads/supplier/proof_of_life/') .$name;
        $headers = $this->get_content_type($name);
        if (file_exists($file)) {
            return response()->download($file, 'Test File', $headers, 'inline');
        } else {
            abort(404, 'File not found!');
        }
    }


  public function view_proof_of_funds($name,$id)
    {
        $file = storage_path('/app/uploads/buyer/') .$id .'/' .$name;
        $headers = $this->get_content_type($name);

        if (file_exists($file)) {
            return response()->download($file,  null, $headers, null);
        } else {
            abort(404, 'File not found!');
        }
    }
}

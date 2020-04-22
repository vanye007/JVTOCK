<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class fileController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function view_certificates($id,$name)
    {
        $file = storage_path('uploads/supplier/certificates/') . $id .'_'.$name;

        if (file_exists($file)) {

            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Type' => 'image/png',
                'Content-Type' => 'image/jpeg'
            ];

            return response()->download($file, 'Test File', $headers, 'inline');
        } else {
            abort(404, 'File not found!');
        }
    }

    public function view_proof_of_life($id,$name)
      {
          $file = storage_path('uploads/supplier/proof_of_life/') . $id . '_'.$name;

          if (file_exists($file)) {

            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Type' => 'image/png',
                'Content-Type' => 'image/jpeg'
            ];

              return response()->download($file, 'Test File', $headers, 'inline');
          } else {
              abort(404, 'File not found!');
          }
      }


      public function view_proof_of_funds($id,$name)
        {
            $file = storage_path('uploads/buyer/certificates/') . $id . '_' .$name;

            if (file_exists($file)) {

              $headers = [
                  'Content-Type' => 'application/pdf',
                  'Content-Type' => 'image/png',
                  'Content-Type' => 'image/jpeg'
              ];

                return response()->download($file, 'Test File', $headers, 'inline');
            } else {
                abort(404, 'File not found!');
            }
        }
}

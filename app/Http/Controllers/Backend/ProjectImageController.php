<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProjectImage;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProjectImageController extends Controller
{
    public function store()
    {
        request()->validate([
            'files' => 'required',
            'files.*' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            //'videos.*' => 'mimetypes:video/mp4|max:25000',
            'project_id' => 'required',
        ]);
    
        
        if(request()->hasfile('files'))
        {
                foreach(request()->file('files') as $file)
                {
                    ProjectImage::create([
                        'path' => $file->store(''),
                        'project_id' => request('project_id')
                    ]);
                }
            
             
            
            /* // Save videos
            if(request()->hasfile('videos'))
            {
                foreach(request()->file('videos') as $file)
                {
                    ProjectImage::create([
                        'path' => $file->store(''),
                        'project_id' => request('project_id')
                    ]);
                }
            } 
            */
    
            return Response::json('Imagens guardadas com sucesso', 200);
        } else{
            return Response::json('Não existem imagens para carregar', 400);
        }

    }

    public function destroy(ProjectImage $projectImage)
    {
        if(File::exists(public_path('\\storage\\'.$projectImage->path))) 
        {
            File::delete(public_path('\\storage\\'.$projectImage->path));
        }

        $projectImage->delete();

        return back()->with('success', 'Imagem eliminada com sucesso!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Avatar;
use App\Frame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FrameController extends Controller
{
    public function index() {
        $page_title = 'Đổi Ảnh Đại Diện';
        $frames = Frame::all();
        $avatar_count = Avatar::count();
        return view( 'frame', compact( 'page_title', 'frames', 'avatar_count' ) );
    }

    public function processImage(Request $req) {
        $res = [
            'success'  => false,
            'url'      => '',
//            'message'  => 'Xử lý ảnh thành công.',
            'error'    => 'Quá trình xử lý ảnh gặp lỗi. Vui lòng thử lại.'
        ];
        $frameID = $req->frameID;
        $imageData = $req->image;
        if( !empty( $frameID ) && !empty( $imageData ) ) {
            $imageData = explode( ',', $imageData );
            $imageData = $imageData[1];
            $imageData = base64_decode( $imageData );
            $croppedImage = imagecreatefromstring( $imageData );
            if( !empty( $croppedImage ) ) {
                $wC = imagesx( $croppedImage );
                $hC = imagesy( $croppedImage );
                $frame = Frame::find( $frameID );
                if( !empty( $frame ) ) {
                    $frameImage = imagecreatefrompng( $frame->url );
                    if( !empty( $frameImage ) ) {
                        $wF = imagesx( $frameImage );
                        $hF = imagesy( $frameImage );
                        $avatar = new Avatar;
                        $avatar->fill([
                            'url'=>''
                        ]);
                        $avatar->save();
                        $outputName = public_path( sprintf( '../uploads/avatar-%1$d.png', $avatar->id ) );
                        $imageURL = asset( sprintf( 'uploads/avatar-%1$d.png', $avatar->id ) );
                        $mergeImage = imagecreatetruecolor( $wC, $hC );
                        imagecopy($mergeImage, $croppedImage, 0, 0, 0, 0, $wC, $hC );
                        imagecopy($mergeImage, $frameImage, 0, 0, 0, 0, $wF, $hF );
                        if( imagepng( $mergeImage, $outputName ) ) {
                            $avatar->url = $imageURL;
                            $avatar->save();
                            $res['success'] = true;
                            $res['url'] = url( 'download' );
                            session([ 'avatarID' => $avatar->id ]);
                        } else {
                            $avatar->delete();
                        }
                        imagedestroy($mergeImage);
                        imagedestroy($croppedImage);
                        imagedestroy($frameImage);
                    }
                }
            }
        }
        return response()->json( $res );
    }

    public function downloadImage(Request $req){
        if( ! $req->session()->has( 'avatarID' ) ) {
            abort( 404 );
        }
        $avatarID = $req->session()->pull( 'avatarID', 0 );
        $avatar = Avatar::findOrFail( $avatarID );
        $pathToFile = public_path( sprintf( 'uploads/avatar-%1$d.png', $avatar->id ) );
        return response()->download( $pathToFile, 'avatar.png' );
    }
}

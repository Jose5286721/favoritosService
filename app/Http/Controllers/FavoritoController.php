<?php
namespace App\Http\Controllers;
use App\Favorite;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FavoritoController extends Controller {
	use ApiResponse;
	public function index() {
		return $this->successResponse(Favorite::all());
	}
	public function showAll($idUsuario) {
		$favoritos = Favorite::where("usuario_id", $idUsuario)->get();
		if (empty($favoritos)) {
			return $this->errorResponse("No hay productos favoritos", Response::HTTP_NOT_FOUND);
		}
		return $this->successResponse($favoritos);
	}
	public function store(Request $request) {
		$this->validate($request, [
			"usuario_id" => "required|min:1",
			"producto_id" => "required|min:1",
		]);
		$favorite = Favorite::create($request->all());
		return $this->successResponse($favorite, Response::HTTP_CREATED);
	}
	public function destroyParams(Request $request){
		$this->validate($request,[
			"usuario_id" => "required|min:1",
			"producto_id" => "required|min:1"
		]);
		$favorito = Favorite::where("usuario_id",$request->usuario_id)->where("producto_id",$request->producto_id)->first();
		$favorito->delete();
		return $this->successResponse($favorito);
	}
	public function destroy($id) {
		$favorite = Favorite::findOrFail($id);
		$favorite->delete();
		return $this->successResponse($favorite);

	}
}

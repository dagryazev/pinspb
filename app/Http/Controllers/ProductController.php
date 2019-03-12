<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Redirector;

class ProductController extends Controller
{
    public function create() {
      $art = Input::get('art');
      $name = Input::get('name');
      try{
        $productModel = new Product;
        if( empty($name) ){
          return redirect()->route('product', ['error' => 'Отсутствует имя']);
        }
        if( strlen( $name ) < 10 ) {
          return redirect()->route('product', ['error' => 'Минимальная длина название 10 символов']);
        }
        if( empty($art)) {
          return redirect()->route('product', ['error' => 'Отсутствует артикул']);
        }
        $productModel->name = $name;
        $productModel->art = $art;
        $productModel->save();
        return redirect()->route('product', ['success' => 'Товар добавлен']);
      } catch (Exception $e) {
        return [
          "status" => "error",
          "message" => $e->getMessage()
        ];
      }
    }

    public function update() {
      $id = Input::post('id');
      $art = Input::post('art');
      $name = Input::post('name');
      try {
        if(empty($id)){
          return redirect()->route('productUpdate', ['error' => 'Отсутствует id товара', 'id' => $id]);
        }
        $productModel = Product::find($id);
        if( empty($name) ){
          return redirect()->route('productUpdate', ['error' => 'Отсутствует имя', 'id' => $id]);
        }
        if( strlen( $name ) < 10 ) {
          return redirect()->route('productUpdate', ['error' => 'Минимальная длина название 10 символов', 'id' => $id]);
        }
        if( empty($art) ){
          return redirect()->route('productUpdate', ['error' => 'Отсутствует артикул', 'id' => $id]);
        }
        if(Auth::user()->role == 'admin'){
          $productModel->art = $art;
        } else {
          return redirect()->route('productUpdate', ['error' => 'Нехватает прав доступа', 'id' => $id]);
        }
        $productModel->name = $name;
        $productModel->save();
        return redirect()->route('productUpdate', ['success' => 'Товар изменен', 'id' => $id]);
      } catch (Exception $e) {
        return [
          "status" => "error",
          "message" => $e->getMessage()
        ];
      }
    }

    public function delete($id) {
      if(!$id)
        return [
          "error" => "Отсутствует id"
        ];
      if(Auth::user()->role == 'admin'){
        Product::find($id)->delete();
        return redirect()->route('product', ['error' => 'Товар удалён']);
      }
    }

    public function showView(){
      if(!Auth::check()) return redirect()->route('login');
      $data['products'] = Product::all();
      if(Input::get('success')){
        $data['success'] = Input::get('success');
      }
      if(Input::get('error')){
        $data['error'] = Input::get('error');
      }
      return view('product.view', $data);
    }

    public function showUpdate($id){
      if(!Auth::check()) return redirect()->route('login');
      $data = Product::find($id);
      if(Input::get('success')){
        $data['success'] = Input::get('success');
      }
      if(Input::get('error')){
        $data['error'] = Input::get('error');
      }
      return view('product.update', $data);
    }
}

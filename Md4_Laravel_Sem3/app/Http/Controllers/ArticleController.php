<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
            public function __construct()
        {
            $this->middleware('auth'); // Ajoutez cette ligne pour exiger une authentification
        }

        //affiche liste contacts
        public function index(){
            $articles= Article::orderBy("nomComplet", "asc")->paginate(5);
            return view('article.index', compact('articles'));
            }
        
            //return formular created contact
            public function create(){
                
                return view('article.create');
            }
                //enregistrer un new contact
                public function store(Request $request){
                    $request->validate([
                        'nomComplet'=>'required',
                        'Email'=> 'required',
                        'telephone' => 'required',
                        'Salaire' => 'required'
                    ]);
                
                    $article = new Article([
                        'nomComplet' => $request->input('nomComplet'),
                        'Email' => $request->input('Email'),
                        'telephone' => $request->input('telephone'),
                        'Salaire' => $request->input('Salaire')
                    ]);
                
                    $article->save();
                
                    return redirect('/')->with('success','Étudiant ajouté avec succès');
                }
                 public function show($id){
                        $article = Article::findOrFail($id);
                        return view('article.show', compact('article'));
                    }
        
                    //edition de contact
                    public function edit($id)
                    {
                        $article = Article::findOrFail($id);
        
                    return view('article.edit', compact('article'));
                    }
                        /**
                 * Enregistre la modification dans la base de données
                 */
                public function update(Request $request, $id)
                {
        
                    $request->validate([
        
                        'nomComplet'=>'required',
                        'Email'=> 'required',
                        'telephone' => 'required',
                        'Salaire' => 'required']);
                    $article = Article::findOrFail($id);
                    $article->update([
                        "nomComplet" => $request->input('nomComplet'),
                             "Email" => $request->input('Email'),
                         'telephone' => $request->input('telephone'),
                           'Salaire' => $request->input('Salaire')]);
        
                    return redirect('/')->with('success', 'contact Modifié avec succès');
                }
                        /**
                 * Supprime le contact dans la base de données
                 */
                public function destroy($id)
                {
                    $article = Article::findOrFail($id);
                    $article->delete();
                    return redirect('/')->with('success', 'contact Supprime avec succès');
        
                }
        
}
<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use crocodicstudio\crudbooster\controllers\CBController;

class AdminRaamatudSkriptistController extends CBController {


    public function cbInit()
    {
        $this->setTable("raamatud_skriptist");
        $this->setPermalink("raamatud_skriptist");
        $this->setPageTitle("Raamatud");

        $this->addText("Autor","autor")->filterable(true)->strLimit(150)->maxLength(512);
		$this->addText("Pealkiri","pealkiri")->filterable(true)->strLimit(150)->maxLength(512);
		$this->addText("Sari","sari")->required(false)->filterable(true)->strLimit(150)->maxLength(512);
		$this->addText("Köide","koide")->required(false)->filterable(true)->strLimit(150)->maxLength(512);
		$this->addText("Žanr","zanr")->required(false)->filterable(true)->strLimit(150)->maxLength(512);
		$this->addText("Kirjastus","kirjastus")->required(false)->filterable(true)->strLimit(150)->maxLength(512);
		$this->addText("Aasta","aasta")->required(false)->filterable(true)->strLimit(150)->maxLength(512);
		$this->addText("Laenutatud","laenutatud")->required(false)->filterable(true)->strLimit(150)->maxLength(512);
		$this->addText("Kogus","kogus")->required(false)->filterable(true)->strLimit(150)->maxLength(512);
    }

    public function postAddSave() {

       try{
        $latest_book = DB::table('raamatud_skriptist')->find(\DB::table('raamatud_skriptist')->max('id'));

        DB::table('raamatud_skriptist')->insert([
            'id' => $latest_book->id + 1,
            'autor'=> $_POST['autor'],
            'pealkiri'=> $_POST['pealkiri'],
            'sari'=> $_POST['sari'],
            'koide'=> $_POST['koide'],
            'zanr'=> $_POST['zanr'],
            'kirjastus'=> $_POST['kirjastus'],
            'aasta'=> $_POST['aasta'],
            'laenutatud'=> $_POST['laenutatud'],
            'kogus'=> $_POST['kogus'],
        ]);
        return cb()->redirectBack(cbLang("the_data_has_been_added"), 'success');
       }
        catch (\Exception $e) {
            Log::error($e);
            echo($e);
        }

    }
}

<?
require '../../includes/config.php';

$action = $_POST['action'];

function init($comm)
{
        $sql = mysqli_query($comm,"SELECT * FROM `articls_categorie`");
        
        $out = array();
        while ($s = mysqli_fetch_assoc($sql)){
                $out[$s['id_categorise']] = $s;
        }
        
       echo json_encode($out);
        
}

 function insert()
{
        $art = R::dispense('articls');
        $art['title']  = $_POST['title'];
        $art['text']  = $_POST['text'];
        $art['image']  = $_POST['image'];
        $art['date']  = date('Y-m-d'); 
        $art['id_categorie']  = $_POST['id_cat'];

        R::store($art);
}

function del_art()
{
        $del = R::findOne('articls','id = ? ', array($_POST['id_art']));
        R::trash($del);
}

function update()
{
        $update = R::findOne('articls','id = ? ', array($_POST['id_art']));
        $update['title'] = $_POST['title'];
        $update['text']  = $_POST['text'];
        $update['image']  = $_POST['image'];
        $update['date']  = date('Y-m-d'); 
        $update['id_categorie']  = $_POST['id_cat'];
        R::store($update);

}

switch ($action) {
    case 'init': init($con);
        break;
    case 'insert': insert();
        break;
    case 'del_art': del_art();
        break;   
    case 'update': update();
        break;       

}




























?>
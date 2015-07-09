<?php
//попробуем создать класс и внутри него работать с БД
class Order {
    public function getOrderList(){

        // $result=DB::query("INSERT `order` SET id=4,content=777");
        $result=DB::query("SELECT order_id,content FROM `order`");

        $html='<h2>Table of orders</h2> <table border="1">';
        while($obj=DB::fetch_object($result)){
            $html.='<tr><td>'.$obj->id.'</td><td>'.$obj->content.'</td><tr>';
        }
        $html.='</table>';
        return $html;
    }
}
?>
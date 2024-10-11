<?php
    function ListarUsuarios(){
        $sql = 'select cd_usuario, nm_usuario,
        nm_email, dt_entrada, cargo_usuario from tb_usuario 
        inner join tb_usuario_conexao on id_usuario = cd_usuario where id_conexao ="'.$_SESSION['conexao'].'" and cargo_usuario != "criador"';

        $res = $GLOBALS['con']->query($sql);

        if($res->num_rows>0){
            return $res;
        }else{
            echo '<div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col-sm-12 text-center">
                            <h4>
                                Sem usuarios na sua conexão!!
                            </h4>
                        </div>
                    </div>
                  </div>';
        }

    }
?>
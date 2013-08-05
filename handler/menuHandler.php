<?php

    class menuHandler{
        
        public $menu;
    
        function menuHandler($grupo){
            $this->exibirMenu($grupo);
        }
        
        function exibirMenu($grupo){
            if($grupo == Admin){
                $this->menu .= "<li><a href='../assets/smd_principal.php' target='frame'><i class='icon-home'></i> Home</a></li>"; 
                $this->menu .= "<li class='dropdown' id='accountmenu'>";  
                $this->menu .= "<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Usuário <b class='caret'></b></a>";  
                $this->menu .= "<ul class='dropdown-menu'>";  
                $this->menu .= "<li class='text-left'><a href='cadastro.php' target='frame'>Cadastro</a></li>";  
                $this->menu .= "<li class='text-left'><a href='consulta.php' target='frame'>Consulta</a></li>";  
                $this->menu .= "</ul>";
                $this->menu .= "</li>";
                $this->menu .= "<li class='dropdown' id='accountmenu'>";
                $this->menu .= "<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Conta <b class='caret'></b></a>";  
                $this->menu .= "<ul class='dropdown-menu'>";  
                $this->menu .= "<li class='text-left'><a href='../conta/busca.php' target='frame'>Busca</a></li>";
                $this->menu .= "</ul>";
                $this->menu .= "</li>";
            }else{
                $this->menu .= "
                    <li style='vertical-align:middle;'>
                        <form class='navbar-form pull-left' method='POST' action='consulta.php' target='frame'>
                            <input type='hidden' name='action'>
                            <div style='position:absolute;' class='input-group'>
                                <input type='text' style='width:400px;' name='usuario_busca' class='form-control'>
                                <span class='input-group-btn'>
                                    <button class='btn btn-inverse' type='submit'><i class='icon-white icon-search'></i></button>
                                </span>
                            </div>
                        </form>
                    </li>"; 
            }
        }
    }

?>

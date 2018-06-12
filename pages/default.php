<?php
require_once (__DIR__ . '/../config/runtime.php');
?>
<div class="font-large text-grey align-right margin-bottom-min page-title">
    Proficionais/ Empresas
</div>
<div class="row-pad">
    <?php
    $select = new Select();
    $select->selectQuery("register");
    if ($select->selectCount()) {
        foreach ($select->selectResult() as $data) {
            ?>
            <div class="col-33b profile-response">
                <a class="btn button-block bg-indigo bg-dark-blue-hover text-white font-medium">
                    <div class="align-left"><?= $data->name ?></div>
                </a>
                <div class="table padding-top-min">
                    <div class="tcell vertical-top">
                        <div class="bg-black image-photo">
                            <img src="perfil-masc.png" class="image-logo"/>
                            <a class="btn button-block bg-light-grey bg-light-black-hover text-grey text-white-hover">Visualizar Dados</a>
                        </div>
                    </div>
                    <div class="tcell vertical-top">
                        <ul class="padding-left-min list-none desc-user-response">
                            <li class="line-block border-bottom border-dark box-fluid-99 break">
                                <p class="bold">Serviço:</p> <?= $data->service ?>
                            </li>
                            <li class="line-block border-bottom border-dark box-fluid-99 break">
                                <p class="bold">Estado:</p> <?= $data->country ?>
                            </li>
                            <li class="line-block border-bottom border-dark box-fluid-99 break">
                                <p class="bold">Cidade:</p> <?= $data->citie ?>
                            </li>
                            <li class="line-block border-bottom border-dark box-fluid-99 break">
                                <p class="bold">Bairro:</p> <?= $data->district ?>
                            </li>
                            <li class="line-block border-bottom border-dark box-fluid-99 break">
                                <p class="bold">Contato:</p> <?= $data->contact ?>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        include (__DIR__ . '/not_found.php');
    }
    ?>
</div>

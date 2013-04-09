<?php
    session_start();
    include("../engine/pasauthent.php");
    include("../engine/db.incl.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Carte de voeux - Intranet SETEC</title>
        
        <!-- Favicon Link -->
        <link rel="shortcut icon" type="images/x-icon" href="<?php print($adress); ?>/favicon.ico"/>

        <!-- CSS Links -->
        <link rel="stylesheet" type="text/css" href="<?php print($adress); ?>/css/layout.css" />
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/bootstrap-lightbox.min.css" rel="stylesheet">
        <style>
            body {
                margin: 8px;
            }

            .titre-image {
                font-size: 12px;
                margin: 3px 0;
            }

            #header_list, #search_input {
                padding: 1px 0;
            }
        </style>

    </head>
    <body>
        <!-- les bubulles -->
        <div id="main_div" style="margin:0 auto;">
            <div id="header">
                <span id="header_logo"><a href="<?php print($adress); ?>" target="_self"><img src="<?php print($adress); ?>/images/header_logo.jpg" width="259" height="110" border="0" alt="SETEC - Intranet" title="SETEC - Intranet" /></a></span>
                <span id="header_go_search"><a href="javascript:go_search();" target="_self"><img src="<?php print($adress); ?>/images/header_go_search_button.jpg" width="27" height="25" border="0" alt="Lancer la recherche" title="Lancer la recherche" /></a></span>
                <div id="search_input_div"><input type="text" id="search_input" value="Rechercher" onclick="this.value=''" onblur="javascript:chk_search();" onkeydown="javascript:search_keypress(event);"  /></div>
                <div id="header_list_div"><form><select id="header_list" onChange="javascript:direct_access(this.form);"><option value="#" selected="selected">Autres Applications</option>             
                
                <?php
                    $sel_req = "SELECT * FROM `header_list` ORDER BY `rank` ASC";
                    $recordset = mysql_query($sel_req);
                    
                    $html = "";
                    
                    while($row = mysql_fetch_array($recordset, MYSQL_ASSOC)){
                    
                        $html .= "<option value='".utf8_encode($row['url'])."'>".utf8_encode($row['title'])."</option>";
                    
                    }
                    
                    print($html);
                ?>
                
                </select></form></div>
                
                <!-- MENU BULLES -->
                <?php
                    $filiale = $_SESSION['filiale_id'];
                    
                    $sel_req1 = "SELECT `intranet` FROM `filiales` WHERE `id`='".$filiale."';";
                    $recordset1 = mysql_query($sel_req1);
                    $res = mysql_fetch_array($recordset1);
                    
                    $filiale_intra = $res['intranet'];
                    
                    $sel_req = "SELECT * FROM `header_menu` ORDER BY `num_bulle` ASC";
                    $recordset = mysql_query($sel_req);
                    
                    $html = "";
                    
                    while($result = mysql_fetch_array($recordset, MYSQL_ASSOC)){
                        
                        $html .= "<div id='menu_bulle".$result['num_bulle']."'";
                        if($result['visible'] == 0){
                            $html .= " style='display:none;'";  
                        }
                        
                        $externe = 0;
                        
                        if($result['active'] == 1){
                            
                            if($result['filiale'] == 1){
                                $html .= "><a href='".$filiale_intra."'";
                                $externe = 1;
                            }else{
                                $html .= "><a href='".$result['url']."'";
                            }
                            
                            if($result['url_type'] == 'externe' || $externe == 1){
                                $html .= " target='_blank'";    
                            }
                            
                            $html .= ">";
                        }else{
                            $html .= "><a href=\"javascript:alert('Cette rubrique sera activ&eacute;e prochainement.');\"";
                            $html .= ">";
                        }
                        
                        $html .= "<img src='".$web_adress."/uploads/images/menu/".$result['img_src']."' border='0' alt='".utf8_encode($result['title'])."' title='".utf8_encode($result['title'])."' />";
                        $html .= "</a></div>";
                        
                    }
                    
                    print($html);
                
                ?>
                        
            </div>
        </div>
        <div class="container">
            <div class="page-header caption pagination-centered">
                <h1>Vœux 2013</h1>
            </div>
            <p>
                <ul>
                    <li>Cette année, vous avez à votre disposition une carte générique ou une carte dédiée à votre société sous forme d'image.</li>
                    <li>Pour les utiliser dans votre message, reportez vous à la <a href="test.php?type=pdf&nom=notice-voeux-2013.pdf" target="_blank">notice</a>. <br />
                        En cas de difficulté, merci de vous rapprocher de votre administrateur informatique.
                </ul>
            </p>
            <!-- <table class="table table-bordered" style="margin-top: 25px;">
                <thead>
                    <tr>
                        <th>Titre</th><th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Carte générique groupe setec</td><td><a href="" class="btn gallery">Télécharger</a></td>
                    </tr>
                </tbody>
            </table> -->

            <br /><br />

            <ul class="thumbnails">
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/Groupe-setec-ecarte2013.png" alt="GROUPE SETEC" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">GROUPE SETEC</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=Groupe-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>
                        </div>
                    </div>
                </li>   
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/als-setec-ecarte2013.png" alt="SETEC ALS" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">SETEC ALS</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=als-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>
                        </div>
                    </div>
                </li>
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/batiment-setec-ecarte2013.png" alt="SETEC BATIMENT" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">SETEC BATIMENT</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=batiment-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>
                        </div>
                    </div>
                </li>
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/diades-setec-ecarte2013.png" alt="DIADES" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">DIADES</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=diades-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>
                        </div>
                    </div>
                </li>
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/energysolutions-setec-ecarte2013.png" alt="SETEC ES" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">SETEC ES</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=energysolutions-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>
                        </div>
                    </div>
                </li>     
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/hydratec-setec-ecarte2013.png" alt="HYDRATEC" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">HYDRATEC</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=hydratec-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>
                        </div>
                    </div>
                </li>   
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/industrie-service-setec-ecarte2013.png" alt="SETEC INDUSTRIES SERVICES" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">SETEC INDUSTRIES SERVICES</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=industrie-service-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>
                        </div>
                    </div>
                </li>  
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/inter-setec-ecarte2013.png" alt="SETEC INTERNATIONAL" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">SETEC INTERNATIONAL</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=inter-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>
                        </div>
                    </div>
                </li>  
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/is-setec-ecarte2013.png" alt="SETEC IS" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">SETEC IS</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=is-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>                        
                        </div>
                    </div>
                </li>  
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/ITS-setec-ecarte2013.png" alt="SETEC ITS" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">SETEC ITS</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=ITS-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>                        
                        </div>
                    </div>
                </li>
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/lerm-setec-ecarte2013.png" alt="LERM" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">LERM</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=lerm-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>                        
                        </div>
                    </div>
                </li>  
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/novae-setec-ecarte2013.png" alt="SETEC NOVAE" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">SETEC NOVAE</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=novae-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>                        
                        </div>
                    </div>
                </li>  
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/orga-setec-ecarte2013.png" alt="SETEC ORGANISATION" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">SETEC ORGANISATION</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=orga-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>                        
                        </div>
                    </div>
                </li>  
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/partdev-setec-ecarte2013.png" alt="PARTENAIRES DEVELOPPEMENT" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">PARTENAIRES DEVELOPPEMENT</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=partdev-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>                        
                        </div>
                    </div>
                </li>  
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/planitecbtp-setec-ecarte2013.png" alt="PLANITEC BTP" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">PLANITEC BTP</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=planitecbtp-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>                        
                        </div>
                    </div>
                </li>  
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/serige-setec-ecarte2013.png" alt="SERIGE" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">SERIGE</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=serige-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>                        
                        </div>
                    </div>
                </li>  
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/terrasol-setec-ecarte2013.png" alt="TERRASOL" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">TERRASOL</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=terrasol-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>                        
                        </div>
                    </div>
                </li>  
                <li class="span3">
                    <div class="thumbnail">
                        <img src="img/cartes/tpi-setec-ecarte2013.png" alt="SETEC TPI" class="carte">
                        <div class="caption pagination-centered">
                            <p class="titre-image">SETEC TPI</p>
                            <p>
                                <a data-toggle="lightbox" href="#demoLightbox" class="btn apercu">Aperçu</a>
                                <a href="test.php?type=carte&nom=tpi-setec-ecarte2013.jpg" class="btn btn-primary">Télécharger</a>
                            </p>                        
                        </div>
                    </div>
                </li>             
            </ul>
            <div id="demoLightbox" class="lightbox hide fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="lightbox-header">
                    <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true">×</button>
                </div>
                <div class="lightbox-content">
                   <img src="img/cartes/Groupe-setec-ecarte2013.jpg">
                </div>
            </div>

            <div id="footer" style="clear:both;display:block;position:relative; z-index:50;">
                <span id="send_remarque"><a href="mailto:infosas@sas.setec.fr" target="_blank"><img src="<?php print($adress); ?>/images/footer_send_remarque.jpg" width="157" height="50" border="0" alt="Envoyer une remarque" title="Envoyer une remarque" /></a></span>
            </div>
        </div>

        <script src="js/jquery-1.8.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-lightbox.min.js"></script>

        <script>
            $(document).ready(function() {
                $('a.apercu').click(function(event) {
                    var chemin = $(this).parent().parent().parent().find(".carte").attr("src").replace(".png", ".jpg");
                    $(".lightbox-content").find("img").attr("src", chemin);                  
                });                
            });
        </script>

    </body>
</html>
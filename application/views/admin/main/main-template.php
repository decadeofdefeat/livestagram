<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="utf8">
<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
        <link href="<?php echo base_url(); ?>/css/admin.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>/js/login.js" ></script>
        <script type="text/javascript">
            var site_url = "<?php echo base_url(); ?>";
            

            var timestamp = <?php echo "'".time()."'"; ?>;

            function waitForNewData( ){
                
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url(); ?>poll/admin_get_new_photos",
                    data: { time: timestamp },
                    async: true,
                    cache: false,

                    success: function( data )
                    {
                      
                        var json = eval('(' + data + ')');

                        if( json['photos'] != '')
                        {
                            timestamp = json['timestamp'];

                            var container = $('#slide_container');
                         
                            $.each(json['photos'], function(i, item) {

                                container.prepend('<div class="slide" id="slide_' + item.id + '"> <img width="100" height="100" src="'+item.low_res+'"> <div class="caption">'+
                                 '<p>'+item.user+'</p> </div> <div class="edit_photo"><button onclick="banPhoto(\''+item.id+'\'); return false">Ban This Photo</button> </div></div>');
                            });
                        }

                        
                        setTimeout('waitForNewData()', 3000);
                    },
                    error: function(XMLHTTPRequest, textStatus, errorThrown){
                        setTimeout('waitForNewData()', 15000);
                    }
                });
            }

            $(document).ready(function(){
                waitForNewData();
            });

            function banPhoto( id )
            {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url(); ?>admin/main/ban_photo/",
                    data: { id: id },
                    cache: false,

                    success: function( data )
                    {
                        $("#slide_" + id).remove();
                    }
            });
            }
        </script>
</head>
    <body>
        <div id="center">
            <div id="header">
                <div id="header-inside"><?php $this->load->view('admin/main/' . $header); ?></div>
            </div>
            <div id="menu">
                <div id="menu-inside"><?php $this->load->view('admin/main/' . $menu); ?></div>
            </div>
            <div id="content">
                <?php $this->load->view('admin/main/' . $load_view); ?>
            </div>
            <div id="footer">
                <div id="footer-inside"><?php $this->load->view('admin/main/' . $footer); ?></div>
            </div>
        </div>
    </body>
</html>
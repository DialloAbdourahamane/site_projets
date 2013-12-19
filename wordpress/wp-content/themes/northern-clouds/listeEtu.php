<?php global $user_ID ?>
<?php if( $user_ID ) : ?>
<?php global $current_user ?>
<?php $_SESSION['login']=$current_user->user_login;
$_SESSION['id']=$user_ID;
?>
<?php endif; ?>
<?php
/**
 Template Name: Liste Etu
 */
get_header();
?>
<html>
<head></head>
<body>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<h2><?php the_title(); ?></h2>


</br>

	<div>
		 
		   <title>DataTables</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-1.4.4.min.js" type="text/javascript"></script>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.dataTables.min.js" type="text/javascript"></script>
        
        <style type="text/css">
            @import "<?php echo get_stylesheet_directory_uri(); ?>/css/demo_table_jui.css";
            @import "<?php echo get_stylesheet_directory_uri(); ?>/themes/smoothness/jquery-ui-1.9.2.custom.min.css";
        </style>
        
        <style>
            *{
                font-family:arial;
            }
        </style>
		
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function(){
                $('#datatables').dataTable({
                    "sPaginationType":"full_numbers",
                    "aaSorting":[[2, "desc"]],
                    "bJQueryUI":true
                });
            })
	
});

        </script>
		
            <table id="datatables" class="display">
                <thead>
                    <tr>
                        <th>Nom</th>
						<th>Prenom</th>
						<th>Email</th>
                        
                    </tr>
                </thead>
                <tbody>
                   <?php 
						   $users = get_users('role=etudiant');
						   foreach( $users as $user ) { 
						  
						  ?>
							  <tr>
								  <td><?php echo the_author_meta('last_name',$user->ID ); ?></td>
								  <td><?php echo $user->display_name ?></td>
								  <td><?php echo $user->user_email; ?></td>
							  </tr>
							
						  <?php	
						  }
							 
                       ?>
                </tbody>
            </table>
        </div>



<?php endwhile; else: ?>
<?php endif; ?>
<?php comments_template( '', true ); ?>

</section>
</body>
</html>
<?php get_sidebar('2'); ?>

<?php get_footer(); ?>
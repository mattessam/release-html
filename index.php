
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="Css/style.css" />
    <link rel="stylesheet" type="text/css" href="Css/feature.css" />
    <link type="text/css" href="DatePicker/css/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
    
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" ></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.5.3/jquery-ui.min.js" ></script>
        <script type="text/javascript" src="DatePicker/jquery-ui-1.8.17.custom.min.js"></script>
	<script src="DatePicker/jquery.ui.widget.js"></script>
        <script src="DatePicker/jquery.ui.core.js"></script>
        
        
       <script type="text/javascript">
            $(document).ready(function(){
		$("#featured > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
            });
        </script>

	<script type="text/javascript">
			$(function(){

				// Datepicker
				$('#datepicker').datepicker({
					inline: true
				});
                                
                        });
				
		</script>
  </head>
  
<body>
  <div id="mainwrapper">
	
    <div id ="topbar">
	
		<div id="banner" class="headcontainer">
		
	  		<div id="logo">
	    
	    		<img src="Images/Logo.png"/>
	  		</div><!--end logo-->
	  
		</div><!--end banner-->
    </div>
      
      
    <header>
    
		<nav class="headcontainer">
                <ul class="clearfix">
                    <li><a href="index.php" title="Home" />HOME</a></li>
                    <li><a href="#" title="About" />EVENTS</a></li>
                    <li><a href="#" title="Blog" />CLUBS</a></li>
                    <li><a href="#" title="Links" />NEWS</a></li>
                </ul>
         </nav>
    	   
     </header>
      
      
    <div id="container" class="contain">
    	<section id="feature">
   
			<div id="sidebar" class="clearfix">
    	
				<div id="dateheader">
                	<h3> Event Calendar</h3>
                </div><!--end date header-->                                                                
    
                                                                                
        		<div id="datepicker">                                                                   
        	
        		</div>   
                             
			</div><!--end sidebar-->

		
	 
		
        <div id="featured" >
		<ul class="ui-tabs-nav">
	        <li class="ui-tabs-nav-item ui-tabs-selected" id="nav-fragment-1"><a href="#fragment-1"><span>Hideout 2012</span></a></li>
	        <li class="ui-tabs-nav-item" id="nav-fragment-2"><a href="#fragment-2"><span>20 Beautiful Long Exposure Photographs</span></a></li>
	        <li class="ui-tabs-nav-item" id="nav-fragment-3"><a href="#fragment-3"><span>35 Amazing Logo Designs</span></a></li>
	        <li class="ui-tabs-nav-item" id="nav-fragment-4"><a href="#fragment-4"><span>Create a Vintage Photograph in Photoshop</span></a></li>
                </ul>

	    <!-- First Content -->
	    <div id="fragment-1" class="ui-tabs-panel" style="">
			<img src="Images/feature1.jpg" alt="" />
			 <div class="info" >
					<h2><a href="#" >Hideout 2012</a></h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tincidunt condimentum lacus. Pellentesque ut diam....<a href="#" >read more</a></p>
			 </div>
	    </div>

	    <!-- Second Content -->
	    <div id="fragment-2" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="images/image2.jpg" alt="" />
			 <div class="info" >
					<h2><a href="#" >20 Beautiful Long Exposure Photographs</a></h2>
					<p>Vestibulum leo quam, accumsan nec porttitor a, euismod ac tortor. Sed ipsum lorem, sagittis non egestas id, suscipit....<a href="#" >read more</a></p>
			 </div>
	    </div>

	    <!-- Third Content -->
	    <div id="fragment-3" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="images/image3.jpg" alt="" />
			 <div class="info" >
					<h2><a href="#" >35 Amazing Logo Designs</a></h2>
					<p>liquam erat volutpat. Proin id volutpat nisi. Nulla facilisi. Curabitur facilisis sollicitudin ornare....<a href="#" >read more</a></p>
	         </div>
	    </div>

	    <!-- Fourth Content -->
	    <div id="fragment-4" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="images/image4.jpg" alt="" />
			 <div class="info" >
					<h2><a href="#" >Create a Vintage Photograph in Photoshop</a></h2>
					<p>Quisque sed orci ut lacus viverra interdum ornare sed est. Donec porta, erat eu pretium luctus, leo augue sodales....<a href="#" >read more</a></p>
	         </div>
	    </div>

	    </div><!--End Feature Slider-->

	
	</section><!-- End section feature-->
	
    <section class="main">
		<?php echo include('includes/' . $_GET['p'] . '.php')?>
    </section><!--end main-->
    
    
	
    
    </div><!--end container-->
    <div id="footer">
	
	
    </div><!--end footer-->
    
  </div><!--end main wrapper-->   
  </body>
</html>
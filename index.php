<?php

	/**
	 * Class that generates DNA code using a predefined map
	 * User: john.antoniou
	 * Date: 19/05/2017
	 * Time: 02:37
	 */


    require_once("class.JA_DNA_Code.php");

	$custom_map_selected = (int)$_POST['dna-custom-map'];
	$ascii_string = $_POST['dna-string'];
	$dna_convert = new JA_DNA_Code();
	$static_maps = $dna_convert->get_static_dna_maps();
	if ( !empty($custom_map_selected) && $custom_map_selected >= 0 && $custom_map_selected <= 23 ) {
		$dna_convert->set_dna_map($custom_map_selected);
	}
	if ( !empty($ascii_string) ) {
		$dna_string = $dna_convert->get_dna($ascii_string);
		$fm_string = $dna_convert->get_formatted_dna($dna_string);
	}
	if ( empty($fm_string) ) $fm_string = "Your DNA-encoded string will appear here";

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <title>Encode String</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        html {
            height: 100%;
            background-color: #f7f7f7;
            color: #565252;
        }
        h5 {
            margin-bottom: 5px;
        }
        div#dna-converter-container {
            margin: 0 auto;
            max-width: 640px;
            text-align: center;
            padding: 20px;
            margin: 40px auto;
        }
        #dna-converter-help {
            border-radius: 100%;
            background-color: #ddd;
            color: #333;
            font-size: 14px;
            display: block;
            width: 25px;
            height: 25px;
            margin: 0px auto;
            line-height: 2;
            border: 1px solid #ccc;
            cursor: pointer;
        }
        #dna-converter-help-content {
            display: none;
            font-size: 16px;
            line-height: 1.4;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: left;
        }
        ul.dna-map {
            display: block;
            width: 80px;
            list-style: none;
            margin: 20px auto;
            background-color: #eef6fb;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
            border: 1px solid #dfe6ea;
            text-align: center;
        }
        ul.dna-map li {
            text-align: center;
        }
        ul.dna-map li .key {
            font-weight: 600;
        }
        ul.dna-map li .division {
            margin: 0 5px;
        }
        ul.dna-map li .value {
            font-weight: 600;
        }
        ul.dna-map li.map-index {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 5px;
        }
        div#dna-code-response {
            background-color: #fefefe;
            display: block;
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 2px;
            font-size: 14px;
            text-align: left;
            word-break: break-all;
        }
        form {
            margin: 40px auto 20px;
            border: 2px solid #ededed;
            padding: 30px 20px;
            border-radius: 2px;
        }
        form input[type="text"], form textarea {
            padding: 8px 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            width: calc(100% - 22px);
            max-width: calc(100% - 22px);
            border-radius: 2px;
            text-align: left;
            margin-bottom: 10px;
        }
        form textarea {
            display: block;
            height: auto;
            min-height: 200px;
            resize: vertical;
        }
        div#dna-custom-maps-container {
            max-width: 300px;
            margin: 0 auto;
            display: none;
        }
        #dna-custom-maps-container ul.dna-map {
            margin-bottom: 0;
            cursor: pointer;
            opacity: 0.4;
        }
        #dna-custom-maps-container ul.dna-map:hover {
            opacity: 1;
        }
        #dna-custom-maps-container ul.dna-map.active {
            opacity: 1;
        }
        input[type="radio"] {
            visibility: hidden;
        }
        .dna-custom-map-label {
            display: inline-block;
            width: 45%;
        }
        form input[type="submit"] {
            padding: 15px 10px;
            font-size: 14px;
            background-color: #88b951;
            color: #fff;
            display: block;
            width: calc(100%);
            border: 0 none;
            border-radius: 2px;
            margin-top: 20px;
            cursor: pointer;
        }
        .dna-a {
            color: #FBBC05;
        }
        .dna-c {
            color: #0079e2;
        }
        .dna-g {
            color: #64b709;
        }
        .dna-t {
            color: #d25252;
        }
        #dna-card {
            margin: 10px auto;
            width: 150px;
            height: 150px;
            border: 1px solid #ddd;
            background-color: #fff;
        }
        #dna-card-wrap {
            white-space: normal;
            -ms-word-break: break-word;
            word-break: break-word;
            margin: 0 auto;
        }
        #dna-card-wrap > span {
            text-shadow: 1px 1px 1px #fff;
        }
        .qr-image {
            display: block;
            margin: 10px auto;
            border: 1px solid #ddd;
        }
        .cards-container {
            text-align: center;
        }
        .cards-item {
            display: inline-block;
            width: 200px;
            margin: 0 10px 20px;
        }
    </style>
    <script type="text/javascript">

        jQuery(document).ready(function() {

            jQuery('#dna-converter-help').click(function() {

                jQuery('#dna-converter-help-content').slideToggle();

            });

            jQuery('#dna-custom-map-enabled').on("change", function(){
               jQuery('#dna-custom-maps-container').slideToggle();
			});

            jQuery('.dna-custom-map-label ul.dna-map').click(function() {
                jQuery('.dna-custom-map-label ul.dna-map').removeClass('active');
                jQuery(this).addClass('active');
                jQuery(this).parent().children('input').attr("checked", "true");
			});

        });

	</script>

</head>
<body>

<div id="dna-converter-container">

	<h1>DNA Code Generator</h1>
	<div id="dna-converter-help">?</div>
	<div id="dna-converter-help-content">

		<p>
			This tool converts text to dna-encoded string.<br>
			The default map used for the conversion is the following, although you can alter this by checking the "Use Alternate Map".</p>

		<p>
			Each character is one byte, since we aren't using unicode encoding.<br>
			Each byte is divided by two, so we have 4 pairs consisted of two bits each.<br>
			The logic behind this is the fact that DNA has four different letters and a byte has 8 bits.
		</p>

		<ul class="dna-map">
			<li><span class="key">00</span><span class="division">=></span><span class="value">A</span></li>
			<li><span class="key">10</span><span class="division">=></span><span class="value">C</span></li>
			<li><span class="key">01</span><span class="division">=></span><span class="value">G</span></li>
			<li><span class="key">11</span><span class="division">=></span><span class="value">T</span></li>
		</ul>

	</div>
	<?php
		if ( !empty($fm_string) ) {
			?>
            <h5>Your DNA Code:</h5>
            <div id="dna-code-response"><?php echo $fm_string; ?></div>
			<?php
		}
	?>

    <form action="" method="POST">
        <textarea name="dna-string" placeholder="Enter your text here"><?php echo $ascii_string; ?></textarea>
		<input type="checkbox" id="dna-custom-map-enabled" />
		<label for="dna-custom-map-enabled">Use Alternate Map</label>
		<div id="dna-custom-maps-container">

			<?php

				if ( empty($custom_map_selected) ) {
					$custom_map_selected = 0;
				}
				$i = 0;
				foreach ( $static_maps as $static_map ) {

					if ( $custom_map_selected == $i ) {
						$activeclass = " active";
						$checked = 'checked="true"';
					}
					else {
						$activeclass = "";
						$checked = "";
					}
					echo '<div class="dna-custom-map-label">';
					echo '<ul class="dna-map'.$activeclass.'">';
					echo '<li class="map-index">MAP '.($i+1).'</li>';
					foreach ( $static_map as $key => $value ) {

						echo '<li><span class="key">'.$key.'</span><span class="division">=></span><span class="value">'.$value.'</span></li>';

					}
					echo '</ul>';
					echo '<input type="radio" name="dna-custom-map" value="'.$i.'" '.$checked.'/>';
					echo '</div>';
					$i++;

				}

			?>

		</div>

		<input type="submit" value="Convert to DNA" />

	</form>

</div>

</body>
</html>

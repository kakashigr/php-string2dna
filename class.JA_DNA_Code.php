<?php
	/**
	 * Class that generates DNA code using a predefined map
	 * User: john.antoniou (augegr@gmail.com)
	 * Date: 19/05/2017
	 * Time: 02:37
	 */


	class JA_DNA_Code {

		/**
		 * JA_DNA_Code constructor.
		 */
		public function __construct()
		{

			$this->dna_map = $this->get_default_dna_map();

		}

		/**
		 * Generate DNA Maps dynamically
		 * @return mixed
		 */
		public function generate_dna_maps() {

			$dna_array = array(
				'A',
				'C',
				'G',
				'T'
			);

			/*
			 * For dna we have four different letters with four positions.
			 * The pattern must not be repeatable so each letter can only appear once.
			 * This gives us a probability of 4*3*2*1 = 24 different options.
			 * @param $probabilities = 24
			 * */
			$probabilities = 24;

			$i = 0;
			$random_positions = array();
			while ( $i < $probabilities ) {
				if (!in_array($dna_array, $random_positions)) {
					$random_positions[$i] = $dna_array;
					$i++;

				}
				else {
					shuffle($dna_array);
				}
			}

			$ic = 0;
			foreach ( $random_positions as $random_position ) {

				$dna_maps[$ic]["00"] = $random_position[0];
				$dna_maps[$ic]["01"] = $random_position[1];
				$dna_maps[$ic]["10"] = $random_position[2];
				$dna_maps[$ic]["11"] = $random_position[3];
				$ic++;

			}
			return $dna_maps;

		}

		/**
		 * Returns all possible dna maps (static version)
		 * @return array
		 */
		public function get_static_dna_maps() {

			$dna_maps = array(
				array(
					"00" => "A",
					"01" => "C",
					"10" => "G",
					"11" => "T"
				),
				array(
					"00" => "G",
					"01" => "T",
					"10" => "C",
					"11" => "A"
				),
				array(
					"00" => "T",
					"01" => "G",
					"10" => "C",
					"11" => "A"
				),
				array(
					"00" => "G",
					"01" => "C",
					"10" => "A",
					"11" => "T"
				),
				array(
					"00" => "G",
					"01" => "A",
					"10" => "C",
					"11" => "T"
				),
				array(
					"00" => "A",
					"01" => "C",
					"10" => "T",
					"11" => "G"
				),
				array(
					"00" => "A",
					"01" => "T",
					"10" => "C",
					"11" => "G"
				),
				array(
					"00" => "C",
					"01" => "T",
					"10" => "A",
					"11" => "G"
				),
				array(
					"00" => "C",
					"01" => "G",
					"10" => "T",
					"11" => "A"
				),
				array(
					"00" => "G",
					"01" => "A",
					"10" => "T",
					"11" => "C"
				),
				array(
					"00" => "A",
					"01" => "T",
					"10" => "G",
					"11" => "C"
				),
				array(
					"00" => "T",
					"01" => "C",
					"10" => "G",
					"11" => "A"
				),
				array(
					"00" => "T",
					"01" => "A",
					"10" => "G",
					"11" => "C"
				),
				array(
					"00" => "C",
					"01" => "T",
					"10" => "G",
					"11" => "A"
				),
				array(
					"00" => "C",
					"01" => "A",
					"10" => "G",
					"11" => "T"
				),
				array(
					"00" => "C",
					"01" => "A",
					"10" => "T",
					"11" => "G"
				),
				array(
					"00" => "T",
					"01" => "C",
					"10" => "A",
					"11" => "G"
				),
				array(
					"00" => "G",
					"01" => "T",
					"10" => "A",
					"11" => "C"
				),
				array(
					"00" => "A",
					"01" => "G",
					"10" => "C",
					"11" => "T"
				),
				array(
					"00" => "C",
					"01" => "G",
					"10" => "A",
					"11" => "T"
				),
				array(
					"00" => "T",
					"01" => "A",
					"10" => "C",
					"11" => "G"
				),
				array(
					"00" => "G",
					"01" => "C",
					"10" => "T",
					"11" => "A"
				),
				array(
					"00" => "A",
					"01" => "G",
					"10" => "T",
					"11" => "C"
				),
				array(
					"00" => "T",
					"01" => "G",
					"10" => "A",
					"11" => "C"
				)

			);
			return $dna_maps;


		}

		/**
		 * Returns Default DNA Map
		 * @return array
		 */
		private function get_default_dna_map() {

			$output = array(
				'00' => 'A',
				'01' => 'C',
				'10' => 'G',
				'11' => 'T'
			);

			return $output;

		}

		/**
		 * Overwrites DNA Map
		 * @param $dna_map
		 */
		public function set_dna_map($dna_map) {

			$dna_maps = $this->get_static_dna_maps();
			$this->dna_map = $dna_maps[$dna_map];

		}

		/**
		 * Convert string to binary
		 * @param $string
		 * @return array|bool
		 */
		private function strToBin($string) {
			if (!is_string($string))
				return false;
			$output = '';
			for ($i = 0; $i < strlen($string); $i++) {
				$temp = decbin(ord($string{$i}));
				$output .= str_repeat("0", 8 - strlen($temp)) . $temp;
			}
			return str_split($output, 2);
		}


		/**
		 * Returns the DNA encoding of a string
		 * @param $string
		 * @return array|bool|string
		 */
		public function get_dna($string) {

			$bin = $this->strToBin($string);
			if ( !$bin ) {
				return false;
			}
			$combine = $this->dna_map;
			$str = '';

			foreach ($bin as $item) {
				$str .= $combine[$item];
			}
			$output = str_split($str, 4);
			$output = implode("", $output);
			return $output;

		}

		/**
		 * Convert DNA to Binary
		 * @param $dnacode
		 * @return array
		 */
		private function dnatoBin($dnacode) {

			$dna_map = $this->dna_map;
			$dna_map = $this->reverse_dna_map($dna_map);
			$dnacode = str_replace(" ", "", $dnacode);
			$dnacode = str_split($dnacode, 4);
			$binary_out = null;
			foreach ($dnacode as $dnabyte ) {

				$dnabyte = str_replace("A", $dna_map['A'], $dnabyte);
				$dnabyte = str_replace("C", $dna_map['C'], $dnabyte);
				$dnabyte = str_replace("G", $dna_map['G'], $dnabyte);
				$dnabyte = str_replace("T", $dna_map['T'], $dnabyte);
				$binary_out[] = $dnabyte;

			}
			return $binary_out;



		}

		/**
		 * Convert binary to string
		 * @param $string
		 * @return array|bool
		 */
		private function BintoStr($bin) {

			$char = null;
			foreach ( $bin as $bin_item ) {
				$char .= chr(bindec($bin_item));
			}

			return $char;

		}

		private function reverse_dna_map($dna_map) {

			foreach ( $dna_map as $key => $value ) {

				$reversed_map[$value] = $key;

			}
			return $reversed_map;

		}

		/**
		 * Returns the text of the DNA code
		 * @param $string
		 * @return array|bool|string
		 */
		public function get_text($dnacode) {

			$bin = $this->dnatoBin($dnacode);
			if ( !$bin ) {
				return false;
			}
			$text = $this->BintoStr($bin);
			if(strstr($text, PHP_EOL)) {
				$text = str_replace(PHP_EOL, "<br>", $text);
			}
			return $text;


		}

		/**
		 * Returns the html formatted DNA code
		 * @param $dnacode
		 * @return mixed
		 */
		public function get_formatted_dna($dnacode) {

			$dnacode = str_replace('A', '<span class="dna-a">A</span>', $dnacode);
			$dnacode = str_replace('C', '<span class="dna-c">C</span>', $dnacode);
			$dnacode = str_replace('G', '<span class="dna-g">G</span>', $dnacode);
			$dnacode = str_replace('T', '<span class="dna-t">T</span>', $dnacode);
			return $dnacode;

		}


	}
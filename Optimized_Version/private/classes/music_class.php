<?php require_once(PRIVATE_PATH.'/strings.php'); ?>

<?php

class Music extends DatabaseObject
{
   static protected $table_name = "musictbl";

    public  $music_id;  
    public  $music_title;
    public  $music_type;
    //this value in database is ignored by project requirement
    public  $music_duration;
    //music purchased numbers
	public  $music_no_times;
	

	
	//custom functino match string's ending with a target string
    static public function endsWith($currentString, $target)
    {
        $length = strlen($target);
        if ($length == 0) {
            return true;
        }
    
        return (substr($currentString, -$length) === $target);
    }
  
	//input sql and ouput a dynamic sql
    static public function processSql($input)
    {
      if(strpos($input, "music_no_times")!== false)
      {
		$position = strpos($input, "music_no_times");
		//insert " desc " after "music_no_times" inside the string 
        $input = substr_replace($input, " desc ", $position+ strlen("music_no_times"), 0);
      }
      if(static::endsWith($input, "music_title"))
      {
        return $input;
      } 
      return $input.", music_title";
  
	}
	

	//convert posted radio buttons value into sql
	static public function get_search_by_type($searchType, $searchKeyword)
    {
		if($searchKeyword == "")
		{
			return $searchKeyword;
		}
		switch($searchType)
		{
			case "inTitle":
			$search = " where music_title like '%".$searchKeyword."%' ";
			break;
			
			case "stWith":
			$search = " where music_title like '".$searchKeyword."%' ";
			break;
	
			case "exact":
			$search = " where music_title like '".$searchKeyword."' ";
			break;
		}
		return $search;
	}
	
	//convert checkboxes' selection(an array) into a valid $sql
    static public function process_selected_music_type($musicTypeInput)
    {
      $output = "where ";
      for($idx =0; $idx<sizeof($musicTypeInput); $idx++)
      {
        $output .= " music_type='".$musicTypeInput[$idx]."'";
        if($idx != (sizeof($musicTypeInput)-1))
        {
          $output .=" or ";
        }
      }
      return $output." ";
    }
  

	//combine 2 sqls with 2 where clause into one sql
    static public function combined_searchType_musicType($searchType, $searchKeyword, $musicTypeInput)
    {
      $searchType = static::get_search_by_type($searchType, $searchKeyword);
	  $musicType =  static::process_selected_music_type($musicTypeInput);
	  if($searchType == ""){return $musicType;}
	  // make output like "where music_title like '%k%' and ( music_type='p' or music_type='c' )"
      $musicType = substr_replace($musicType, " and (", 0, 5)." ) ";
  
      return $searchType.$musicType;
    }

    

    private static function display_Data_in_color($output, $music, $musicDataResult)
    {
        $output .=  $music->music_title.'</td>
			<td><img src="'.$musicDataResult->m_icon.'" width="80" height="75" /></td>
			<td>'.$music->music_id.'</td>
			<td style="background-color:yellow" >'.$music->music_no_times.'</td>
			<td style="background-color:#e2851d" >'.$musicDataResult->m_price.'</td>
			<td><input type="checkbox" name="musicAddCart[]" value="
					'.$music->music_id.','.$musicDataResult->m_price.'" /></td></tr>';
        print $output;
    }


	//query DB to get a set of objects and display
    public static function get_Data_From_DB($sql)
    {
        $musics = static::find_by_sql($sql);
        
        if($musics)
        {
            $musicData = MusicData::find_all();
            foreach($musics as $music)
            {
                switch($music->music_type)
                {
                    case "p":
                    $musicDataResult = $musicData[0];
                    $output = '<tr>'.MyString::$pop_color_begin;
                    break;
                    
                    case "c":
                    $musicDataResult = $musicData[1];
                    $output = '<tr>'.MyString::$country_color_begin;
                    break;
                    
                    case "j":
                    $musicDataResult = $musicData[2];
                    $output =  '<tr>'.MyString::$jazz_color_begin;
                    break;  
                }
                static::display_Data_in_color($output, $music, $musicDataResult); 
            }
        }     
    }
  

	// combine all queries and methods and display result
	public static function display_music_query_result($searchBox,$searchBy, $musicType,$orderType)
	{
		$sql_begin = "select * from ".self::$table_name." ";
		$order_by = "order by ";
		$searchBox = trim($searchBox);
		
		if(!isset($musicType))
		{
			$search = static::get_search_by_type($searchBy,$searchBox);
			$sql = static::processSql($sql_begin.$search.$order_by.$orderType);
			static::get_Data_From_DB($sql);
		}else{
			$search = static::combined_searchType_musicType($searchBy,$searchBox, $musicType);
			$sql = static::processSql($sql_begin.$search.$order_by.$orderType);
			static::get_Data_From_DB($sql);
		}
		
	}

}



?>
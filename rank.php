<?php
function alexaRank($url) 
{
 $alexaData = simplexml_load_file("http://data.alexa.com/data?cli=10&url=".$url);
 $alexa['globalRank'] =  isset($alexaData->SD->POPULARITY) ? $alexaData->SD->POPULARITY->attributes()->TEXT : 0 ;
 $alexa['CountryRank'] =  isset($alexaData->SD->COUNTRY) ? $alexaData->SD->COUNTRY->attributes() : 0 ;
 return json_decode(json_encode($alexa), TRUE);
}

if(isset($_GET['siteinfo'])) 
{
 $url = $_GET['siteinfo'];
 $alexa = alexaRank($url);
 $globalRank ="Global Alexa Rank of ".$_GET['siteinfo']." is : ".$alexa['globalRank'][0];
 $countryRank ="Alexa Rank In ".$alexa['CountryRank']['@attributes']['NAME']." is : ".$alexa['CountryRank']['@attributes']['RANK'];
}
?>

<html>
<head>
 <link href="rank.css"  rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="wrapper">

 <form method="get" id="rank_form">
  <p>Enter Website To Get Alexa Rank</p>
  <input type="text" name="siteinfo" placeholder="E.g. www.talkerscode.com" required="required"/>
  <input type="submit" value="Find">
</form>

 <p class="rank_para"><?php echo $globalRank; ?></p>
 <p class="rank_para"><?php echo $countryRank;?></p>

</div>
</body>
</html>

<?php

								//If form submitted empty
			if (!isset($_POST['submit']))
			{

					$url=array();
	
					echo "no value entered";
			}
			else
			{
										//Retrieve established url array.

					$url=($_POST['url']);

										//Convert user input string into an array.

					$added=explode(',',$_POST['added']);

										//Add to the established array.
				
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_HEADER, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

					foreach($added as $url1) 
					{
							curl_setopt($ch, CURLOPT_URL, $url1);
							$out = curl_exec($ch);

							// line endings is the wonkiest piece of this whole thing
							$out = str_replace("\r", "", $out);

							// only look at the headers
							$headers_end = strpos($out, "\n\n");
							if( $headers_end !== false ) 
							{ 
								$out = substr($out, 0, $headers_end);
							}   

							$headers = explode("\n", $out);
							foreach($headers as $header) 
							{
								if( substr($header, 0, 10) == "Location: " ) 
								{ 
									$target = substr($header,0);
										// = trim(substr($header, strlen(80)));

										echo ("[$url1] redirects to-------------> <b>[$target]</b> <br />");
										continue 2;
								}   
							}   

						echo "[$url] does not redirect <br />";
					}

				
					
			}

			?>	
				

 



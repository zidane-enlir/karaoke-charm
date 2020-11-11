# Larastanの結果表示

~~~php

root@47a394602bfb:/var/www# ./vendor/bin/phpstan analyse
Note: Using configuration file /var/www/phpstan.neon.
 60/60 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

 ------ -------------------------------------------------------------------------------------------------------- 
  Line   Http/Controllers/PlaylistController.php                                                                 
 ------ -------------------------------------------------------------------------------------------------------- 
  102    Property App\Http\Controllers\PlaylistController::$flash_message (string) does not accept void.         
  102    Result of method App\Repositories\Playlist\PlaylistRepositoryInterface::storeNewPlaylist() (void) is    
         used.                                                                                                   
  173    Property App\Http\Controllers\PlaylistController::$flash_message (string) does not accept void.         
  173    Result of method App\Repositories\Playlist\PlaylistRepositoryInterface::deletePlaylistName() (void) is  
         used.                                                                                                   
 ------ -------------------------------------------------------------------------------------------------------- 

 ------ --------------------------------------------------------------------------------------------------------- 
  Line   Http/Controllers/TrackController.php                                                                     
 ------ --------------------------------------------------------------------------------------------------------- 
  172    Property App\Http\Controllers\TrackController::$track (App\Repositories\Track\TrackRepositoryInterface)  
         does not accept App\Models\Track.                                                                        
 ------ --------------------------------------------------------------------------------------------------------- 

 ------ --------------------------------------------------------------------------------------------------------- 
  Line   Http/Middleware/Authenticate.php                                                                         
 ------ --------------------------------------------------------------------------------------------------------- 
  17     Method App\Http\Middleware\Authenticate::redirectTo() should return string|null but return statement is  
         missing.                                                                                                 
 ------ --------------------------------------------------------------------------------------------------------- 

 -- ---------------------------------------------------------------------------------------- 
     Error                                                                                   
 -- ---------------------------------------------------------------------------------------- 
     Ignored error pattern #Unsafe usage of new static# was not matched in reported errors.  
 -- ---------------------------------------------------------------------------------------- 

                                                                                                                    
 [ERROR] Found 7 errors                                                                                             
                                                                                                                    

root@47a394602bfb:/var/www# 

~~~
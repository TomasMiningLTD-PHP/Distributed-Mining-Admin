<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Miner - Changes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="css/mining_css.css" rel="stylesheet" type="text/css"/>
        <link href="css/login.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
    </head>
    <body>
        <header>
            <div id="header_wrapper">
                <div class="banner"></div>
                <div class="navigation">
                    <div class="navigation_element">
                        <a href="overview">Overview</a>
                    </div>
                    <div class="navigation_element">
                        <a href="changes">Control panel</a>
                    </div>
                    <div class="navigation_element">
                        <a href="logout">Log out</a>
                    </div>
                </div>
            </div>
        </header>
        <section id="main_content">
            <div id="main_wrapper">
                <form class="login-form" action="changes/addUser" method="post">
                    <div class="changes_element">
                        <h2>Add user</h2>
                        <h5><?php if (isset($usermessage)) { echo $usermessage; } ?>
                        </h5>
                        <input name="username" type="text" class="input username" value="Username" onfocus="this.value = ''" /><br/>
                        <input name="password" type="text" class="input username" value="Password" onfocus="this.value = ''" /><br/>
                        <input name="password" type="text" class="input username" value="Retype password" onfocus="this.value = ''" /><br/>
                        <select name="level">
                            <option value="1">Admin</option>
                            <option value="0">User</option>
                        </select>
                    </div>
                    <input type="submit" name="newuser" value="Add new user" class="button" />
                </form>
                <form class="login-form" action="changes/addIp" method="post">
                    <div class="changes_element">
                        <h2>Add ip</h2>
                        <h5><?php if (isset($ipmessage)) { echo $ipmessage; } ?>
                        </h5>
                        <input name="ip" type="text" class="input username" value="IP - address" onfocus="this.value = ''" /><br/>
                    </div>
                    <input type="submit" name="newip" value="Add new ip" class="button" />
                </form>
                <form class="login-form" action="changes/changePool" method="post">
                    <div class="changes_element">
                        <h2>Change pool</h2>
                        <h5><?php if (isset($poolmessage)) { echo $poolmessage; } ?>
                        </h5>
						<select name="pool">
							<?php 
								foreach($pools as $pool)
									echo "<option value=\"$pool\">$pool</option>";
							?>
                        </select>
                    </div>
					<input type="submit" name="changepool" value="Change pool" class="button" />
                </form>
            </div>
        </section>
    </body>
</html>

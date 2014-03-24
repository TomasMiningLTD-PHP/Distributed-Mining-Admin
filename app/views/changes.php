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
        <script type="text/javascript" src="js/checkInput.js"></script>
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
                <div id="change-form">
                <form class="login-form" action="changes" method="post">
                    <div class="content">
                        <h2>Add user</h2>
                        <h5><?php if (isset($usermessage)) { echo $usermessage; } ?>
                        </h5>
                        <input name="username" type="text" class="input username" value="Username" onfocus="this.value = ''" />
                        <input name="password" type="password" class="input password" value="Password" onfocus="this.value = ''" />
                        <input name="passwordre" type="password" class="input password" value="Retype password" onfocus="this.value = ''" />
                        <select name="level" class="select">
                            <option value="1">Admin</option>
                            <option value="0">User</option>
                        </select>
                    </div>
                    <div class="footer">
                    <input type="submit" name="newuser" value="Add new user" class="button" />
                    </div>
                </form>
                <form class="login-form" action="changes" method="post">
                    <div class="content">
						<h2>Add mining server</h2>
                        <h5><?php if (isset($ipmessage)) { echo $ipmessage; } ?>
                        </h5>
                        <input name="ip" type="text" class="input username" value="IP - address" onfocus="this.value = ''" />
                    </div>
                    <div class="footer">
                    <input type="submit" name="newip" value="Add new server" class="button" />
                    </div>
                </form>
                <form class="login-form" action="changes" method="post">
                    <div class="content">
						<h2>Add pool</h2>
                        <h5><?php if (isset($newpoolmessage)) { echo $newpoolmessage; } ?>
                        </h5>
                        <input name="name" type="text" class="input username" value="Pool - name" onfocus="this.value = ''" />
                        <input name="url" type="text" class="input password" value="Pool - url" onfocus="this.value = ''" />
                        <input name="username" type="text" class="input password" value="Pool - username" onfocus="this.value = ''" />
                        <input name="password" type="password" class="input password" value="Pool - password" onfocus="this.value = ''" />
                        <input name="alg" type="text" class="input password" value="Pool - crypto algorithm" onfocus="this.value = ''" />
                    </div>
                    <div class="footer">
                    <input type="submit" name="newpool" value="Add new pool" class="button" />
                    </div>
                </form>
                <form class="login-form" action="changes" method="post">
                    <div class="content">
                        <h2>Change pool</h2>
                        <h5><?php if (isset($poolmessage)) { echo $poolmessage; } ?>
                        </h5>
						<select class="select" name="pool">
							<?php 
								foreach($pools as $pool)
									echo "<option value=\"$pool\">$pool</option>";
							?>
                        </select>
                    </div>
                    <div class="footer">
			<input type="submit" name="changepool" value="Change pool" class="button" />
                    </div>
                </form>
                </div>
            </div>
        </section>
    </body>
</html>

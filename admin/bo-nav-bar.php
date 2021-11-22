		<div class="col-d-2 bgcolor-blue5 btn-menu">
		 	<span class="icon-menu icon-btn-menu" ></span>
		 	<span class="menu-title"><?php echo $title; ?></span>
		</div>
		<nav class="main-nav bgcolor-gray4 col-d-2">
			<div class="nav-profile">
				<div class="img-nav-profile">
					<img src= "<?php echo "profile_img/".$_SESSION['img']; ?>">
				</div>
				<div class="nav-profile-info">
					<p><?php echo $_SESSION['nombre']." ".$_SESSION['apellidos']; ?></p>
					<p><?php echo ($_SESSION['rol']==1)?"Administrar":"Consultar"; ?></p>
				</div>
			</div>
			<ul class="ul-main-nav">
				<li class="li-main-nav ">
					<a href="inicio.php">
						<div class="icon-nav-container  bgcolor-blue5">
							<span class="icon-home icon-main-nav  bgcolor-blue5"></span>
							<span>Home</span>
						</div>
					</a>
				</li>
				<li class="li-main-nav " id="btn-caja">
					<a href="users/">
					<div class="icon-nav-container  bgcolor-blue5">						
						<span class="icon-users icon-main-nav bgcolor-blue5 " title="Usuarios" ></span>
						<span>Usiarios</span>
					</div>
					</a>
				</li>
				<li class="li-main-nav " id="btn-caja">
					<a href="customers/">
					<span class="icon-user-tie icon-main-nav bgcolor-blue5 " title="Usuarios" ></span>
					</a>
				</li>
				<li class="li-main-nav " id="btn-almacen">
					<span class="icon-stats-dots icon-main-nav bgcolor-blue5" title="Reportes"></span>
				</li>
				<li class="li-main-nav " id="btn-almacen">
					<a href="products/">
					<span class="icon-price-tags icon-main-nav bgcolor-blue5" title="Producto"></span>
					</a>
				</li>
				<li class="li-main-nav">
					<a href="logout/">
						<span class="icon-exit icon-main-nav bgcolor-blue5" title="salir"></span>
					</a>	
				</li>
			</ul>
		</nav>
		<div class="col-d-2 bgcolor-blue5 btn-menu">
			<span class="icon-menu icon-btn-menu"></span>
			<span class="menu-title"><?php echo $title;?></span>
		</div>
		<nav class="main-nav bgcolor-blue6 col-d-2">
			<div class="nav-profile" data-id="<?php echo $_SESSION['id']; ?>">
				<div class="img-nav-profile">
					<img src= "<?php echo "../profile_img/".$_SESSION['img']; ?>">
				</div>
				<div class="nav-profile-info">
					<p><?php echo $_SESSION['nombre']." ".$_SESSION['apellidos']; ?></p>
					<p><?php echo ($_SESSION['rol']==1)?"Administrar":"Consultar"; ?></p>
				</div>
			</div>
			<ul class="ul-main-nav">
				<li class="li-main-nav bgcolor-blue5">
					<a href="../inicio.php">
						<div class="icon-nav-container bgcolor-blue5">
							<span class="icon-home icon-main-nav  "></span>
							<span>Home</span>
						</div>
					</a>
				</li>
				<li class="li-main-nav bgcolor-blue5" id="btn-menu-usuarios">
					<div class="icon-nav-container bgcolor-blue5">
						<span class="icon-user icon-main-nav"></span>
						<span>Usuarios</span>
					</div>
				</li>
				<li class="li-main-nav bgcolor-blue5" id="btn-menu-clientes">
					<div class="icon-nav-container bgcolor-blue5">
						<span class="icon-user-tie icon-main-nav"></span>
						<span>Clientes</span>
					</div>
				</li>
				<li class="li-main-nav bgcolor-blue5" id="btn-menu-productos">
					<div class="icon-nav-container bgcolor-blue5">
						<span class="icon-price-tags icon-main-nav"></span>
						<span>Productos</span>
					</div>
				</li>
				<li class="li-main-nav bgcolor-blue5" id="btn-menu-pedidos">
					<a href="../pedidos/lista-pedidos.php">
					<div class="icon-nav-container bgcolor-blue5">
						<span class="icon-cart icon-main-nav"></span>
						<span>Pedidos</span>
					</div>
					</a>
				</li>
				<li class="li-main-nav bgcolor-blue5" id="btn-menu-pedidos">
					<a href="../sales/">						
						<div class="icon-nav-container bgcolor-blue5">
							<span class="icon-coin-dollar icon-main-nav"></span>
							<span>Ventas</span>
						</div>
					</a>
				</li>
				<li class="li-main-nav bgcolor-blue5">
					<a href="../logout/">
						<div class="icon-nav-container bgcolor-blue5">
							<span class="icon-exit icon-main-nav" title="salir"></span>
							<span>Salir</span>
						</div>
					</a>	
				</li>
			</ul>
		</nav>
		<nav class="users-main-nav bgcolor-blue6 col-d-2">
			<ul class="ul-main-nav">
				<li class="li-main-nav bgcolor-blue5" id="btn-close-menu-usuarios">
						<div class="icon-nav-container">
							<span class="icon-undo icon-main-nav"></span>
							<span>Atras</span>
						</div>
				</li>
				<li class="li-main-nav bgcolor-blue5" id="btn-menu-usuarios">
					<a href="../users/registro.php">
						
					<div class="icon-nav-container bgcolor-blue5">
						<span class="icon-plus icon-main-nav bgcolor-blue5"></span>
						<span>Agregar</span>
					</div>
					</a>
				</li>
				<li class="li-main-nav bgcolor-blue5" id="btn-menu-usuarios">}
					<a href="../users/users-list.php">
						
					<div class="icon-nav-container bgcolor-blue5">
						<span class="icon-list icon-main-nav bgcolor-blue5"></span>
						<span>Lista</span>
					</div>
					</a>
				</li>
			</ul>
		</nav>
		<nav class="customers-main-nav bgcolor-blue6 col-d-2">
			<ul class="ul-main-nav">
				<li class="li-main-nav bgcolor-blue5" id="btn-close-menu-customers">
					<div class="icon-nav-container">
						<span class="icon-undo icon-main-nav"></span>
						<span>Atras</span>
					</div>
				</li>
				<li class="li-main-nav bgcolor-blue5" id="btn-menu-usuarios">
					<a href="../customers/registro.php">
						
					<div class="icon-nav-container bgcolor-blue5">
						<span class="icon-plus icon-main-nav bgcolor-blue5"></span>
						<span>Agregar</span>
					</div>
					</a>
				</li>
				<li class="li-main-nav bgcolor-blue5" id="btn-menu-usuarios">
					<a href="../customers/customers-list.php">
						
					<div class="icon-nav-container bgcolor-blue5">
						<span class="icon-list icon-main-nav bgcolor-blue5"></span>
						<span>Lista</span>
					</div>
					</a>
				</li>
			</ul>
		</nav>
		<nav class="products-main-nav bgcolor-blue6 col-d-2">
			<ul class="ul-main-nav">
				<li class="li-main-nav bgcolor-blue5" id="btn-close-menu-products">
					<div class="icon-nav-container">
						<span class="icon-undo icon-main-nav"></span>
						<span>Atras</span>
					</div>
				</li>
				<li class="li-main-nav bgcolor-blue5" id="btn-menu-usuarios">
					<a href="../products/registro.php">
						
					<div class="icon-nav-container bgcolor-blue5">
						<span class="icon-plus icon-main-nav bgcolor-blue5"></span>
						<span>Agregar</span>
					</div>
					</a>
				</li>
				<li class="li-main-nav bgcolor-blue5" id="btn-menu-usuarios">
					<a href="../products/products-list.php">
					<div class="icon-nav-container bgcolor-blue5">
						<span class="icon-list icon-main-nav bgcolor-blue5"></span>
						<span>Lista</span>
					</div>
					</a>
				</li>
			</ul>
		</nav>
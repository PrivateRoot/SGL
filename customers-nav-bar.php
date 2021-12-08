		<div class="col-d-2 bgcolor-blue5 btn-menu">
			<span class="icon-menu icon-btn-menu"></span>
			<span class="menu-title"><?php echo $title;?></span>
		</div>
		<nav class="main-nav bgcolor-blue6 col-d-2">
			<div class="nav-profile" data-customerid="<?php echo $_SESSION['customerid']; ?>">
				<div class="nav-profile-info">
					<p><?php echo $_SESSION['nombre']." ".$_SESSION['apellidos']; ?></p>
					<p><?php echo $_SESSION['correo']; ?></p>
				</div>
			</div>
			<ul class="ul-main-nav">
				<li class="li-main-nav bgcolor-blue5">
					<a href="productos.php">
						<div class="icon-nav-container  bgcolor-blue5">
							<span class="icon-home icon-main-nav  bgcolor-blue5"></span>
							<span>Home</span>
						</div>
					</a>
				</li>
				<li class="li-main-nav bgcolor-blue5" id="btn-caja" >
					<!-- <a href="carrito.php"> -->
						<div class="icon-nav-container btn-cart-nav bgcolor-blue5" data-customerid="<?php echo $_SESSION['customerid']; ?>">
							<span class="icon-cart icon-main-nav bgcolor-blue5" title="Punto de venta" ></span>
							<span>carrito</span>
						</div>
					<!-- </a> -->
				</li>
				<li class="li-main-nav bgcolor-blue5">
					<a href="logout/">
						<div class="icon-nav-container  bgcolor-blue5">
							<span class="icon-exit icon-main-nav bgcolor-blue5" title="salir"></span>
							<span>Salir</span>
						</div>
					</a>	
				</li>
<!-- 				<li class="li-main-nav">
					<div class="icon-nav-container  bgcolor-blue5">
						<span class="icon-cogs icon-main-nav bgcolor-blue5" title="Editar perfil"></span>
						<span>Configuracion de la cuenta</span>
					</div>
				</li> -->
			</ul>
		</nav>
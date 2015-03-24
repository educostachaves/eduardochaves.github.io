<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php if(!isset($titulo)):  ?> {titulo} <?php endif; ?> {titulo_padrao}</title>

    {headerinc}

  </head>
  <body>
    <?php if (esta_logado(false)): ?>
    <header class="container">
      <div class="row">
        <div class="large-6 columns">
          <a href="<?php echo base_url('painel'); ?>">
            <h1>Painel Administrativo</h1>
          </a>
        </div>
        <div class="large-6 columns">
          <p class="text-right">Logado como <b><?php echo $this->session->userdata('user_nome'); ?></b></p>
          <p class="text-right">
            <?php echo anchor('usuarios/alterar_senha'.$this->session->userdata('user_id'),'Alterar Senha', 'class="button radius tiny"'); ?>
            <?php echo anchor('usuarios/logoff','Sair', 'class="button radius tiny alert"'); ?>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="large-12 columns menu">
          <nav class="top-bar" data-topbar>
            <section class="top-bar-section">
              <ul class="left">
                <li><?php echo anchor('painel','Início'); ?></li>
                <li class="has-dropdown">
                  <?php echo anchor('usuarios/gerenciar','Usuários'); ?>  
                  <ul class="dropdown">
                    <li><?php echo anchor('usuarios/cadastrar','Cadastrar'); ?></li>
                    <li><?php echo anchor('usuarios/gerenciar','Gerenciar'); ?></li>
                  </ul>
                </li>
                <li class="has-dropdown">
                  <a href="">Administração</a>
                  <ul class="dropdown">
                    <li><?php echo anchor('auditoria/gerenciar','Gerenciar'); ?></li>
                  </ul>
                </li>
                <li class="has-dropdown">
                  <?php echo anchor('midia/gerenciar','Mídia'); ?>  
                  <ul class="dropdown">
                    <li><?php echo anchor('midia/cadastrar','Cadastrar'); ?></li>
                    <li><?php echo anchor('midia/gerenciar','Gerenciar'); ?></li>
                  </ul>
                </li>
                <li class="has-dropdown">
                  <?php echo anchor('paginas/gerenciar','Páginas'); ?>  
                  <ul class="dropdown">
                    <li><?php echo anchor('paginas/cadastrar','Cadastrar'); ?></li>
                    <li><?php echo anchor('paginas/gerenciar','Gerenciar'); ?></li>
                  </ul>
                </li>
              </ul>
            </section>
          </nav>
        </div>
      </div>
    </header>
    <?php endif; ?>
    <section class="container">
      <div class="row">
        {conteudo}
      </div>
    </section>
    <footer class="container">
      <div class="row">
        <div class="large-12 columns text-center">
          {rodape}    
        </div>
      </div>
    </footer>  
    
    {footerinc}
  </body>
</html>

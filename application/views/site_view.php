<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php if(!isset($titulo)):  ?> {titulo} <?php endif; ?> {titulo_padrao}</title>

    {headerinc}

  </head>
  <body>
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

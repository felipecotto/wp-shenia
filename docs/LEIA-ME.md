# Site Shenia Karlsson · desenvolvimento local

## Rodar no Windows com o LocalWP
1. Instale o Local (localwp.com) e crie um site chamado `shenia` (ambiente "Preferred", PHP 8.2 ou mais).
2. Em WP Admin > Configurações > Geral, idioma "Português do Brasil" e fuso "Lisboa".
3. Ligue o tema desta pasta ao site do Local com um link de diretório. No Prompt de Comando (como administrador):

   ```
   mklink /J "%USERPROFILE%\Local Sites\shenia\app\public\wp-content\themes\shenia" "C:\Projetos\wp-shenia\wp-content\themes\shenia"
   ```

   Assim o Local usa o tema que está aqui, versionado no git.
4. Em Aparência > Temas, ative "Shenia Karlsson".
5. Crie uma página "Guia de estilo", escolha o modelo "Página sem título (seções)" e insira o padrão "Guia de estilo (página de teste)" (categoria Páginas Shenia). É a página para conferir tipografia, cores e botões.
6. Em Configurações > Links permanentes, escolha "Nome do post".

## Copie para esta pasta docs/
- prompt-cursor-v11.md
- prompt-cursor-tipografia.md
- prompt-cursor-empresas-e-marcas.md
- prompts-cursor-wordpress.md

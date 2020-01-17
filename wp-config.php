<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wp_woocommerce' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'S|Xu/AE|O1fPR{lqn}fVlUy?B/b(RRh`*(kR:r74y@xbHg})WhA3D6`YRFj|r$F&' );
define( 'SECURE_AUTH_KEY',  'j7Uj|3.jdu2/Hk[`^E<7R!l,+&w`h|3fiRy-q4rUsgsl^9,_yJAAGaiC=wsIbTy/' );
define( 'LOGGED_IN_KEY',    'mdxNZ/?adXy5-)5OV4?BS^6KJwR=^.*68R4b.r-0aC}~nP[%z<LzG=s;A+kw29t:' );
define( 'NONCE_KEY',        'DK-9K>t:%-U$<LzGU_`_S<?`hf/sXUYSk{KWl;?||4=;?aWG}NA3PRQ_,?nm/jV7' );
define( 'AUTH_SALT',        'hcGRx}9NK3ql&?b#);Z)qMSm2Q7Irb(5&I~,MEINN,W|rr`}fdU|Kw1/e{<zA-Ni' );
define( 'SECURE_AUTH_SALT', 'r/j,bj,d,kwjY)b%+<nGp-*5y8(d<Zi%HfKRRba}L=Z7v4s88zb51>I4Y3G|c+~S' );
define( 'LOGGED_IN_SALT',   'F-!dexS-t3vK`ldatRZqL/~jp$VkVEX,7M,jy|9Qhc~-)7w/!Gy_)dp~:jqbT ia' );
define( 'NONCE_SALT',       '+G5qMR)5,nl[-vtH0>$kOv=63TGq837s9exr /_k%)|KVLKK6TKHs`Ooa/B*8(8E' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wooWP_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');

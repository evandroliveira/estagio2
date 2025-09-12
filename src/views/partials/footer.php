<?php
// footer.php - partial de rodapé
// Defina as variáveis $siteName, $author, $email, $phone, $address, $social antes de incluir este arquivo
// Exemplo antes de incluir: $siteName = 'Minha Empresa'; $author = 'Fulano'; $email = 'contato@meu.com';
// $social = [['name'=>'GitHub','url'=>'https://github.com/usuario'], ['name'=>'LinkedIn','url'=>'https://linkedin.com/in/usuario']];

$siteName = $siteName ?? 'evandro.oliveira';
$author   = $author   ?? 'Evandro Aurelio de Oliveira';
$email    = $email    ?? 'evandro@gmail.com';
$phone    = $phone    ?? '+55 (44) 99999-9999';
$address  = $address  ?? 'Nova Olímpia, Parana';
$social   = $social   ?? []; // array de arrays: ['name'=>'GitHub','url'=>'...']
?>
<footer role="contentinfo" style="background:#f8f9fa;padding:20px 16px;border-top:1px solid #e9ecef;font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#333;">
    <div style="max-width:1100px;margin:0 auto;display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center;">
        <div style="min-width:220px;">
            <strong><?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?></strong><br>
            <span><?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?></span><br>
            <a href="mailto:<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" style="color:#007bff;text-decoration:none;"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></a>
            <?php if ($phone): ?> · <a href="tel:<?php echo htmlspecialchars(preg_replace('/\s+/', '', $phone), ENT_QUOTES, 'UTF-8'); ?>" style="color:#007bff;text-decoration:none;"><?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?></a><?php endif; ?>
        </div>

        <div style="text-align:right;min-width:200px;">
            <div style="margin-bottom:6px;">
                <?php echo htmlspecialchars($author, ENT_QUOTES, 'UTF-8'); ?> · &copy; <?php echo date('Y'); ?>
            </div>

            <?php if (!empty($social)): ?>
                <div>
                    <?php foreach ($social as $item): 
                        $name = isset($item['name']) ? $item['name'] : 'Link';
                        $url  = isset($item['url']) ? $item['url'] : '#';
                    ?>
                        <a href="<?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" style="margin-left:8px;color:#495057;text-decoration:none;font-size:13px;">
                            <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>
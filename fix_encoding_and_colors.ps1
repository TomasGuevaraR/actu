$projectRoot = "c:/xampp/htdocs/mis proyectos/admiglesia"

# Define replacement rules for broken characters
$replacements = @{
    "AdministraciÃ³n"     = "Administración"
    "IdentificaciÃ³n â¬" = "Identificación ⬆️"
    "Nombres â¬"         = "Nombres ⬆️"
    "Ã³"                  = "ó"
    "Ã¡"                  = "á"
    "Ã©"                  = "é"
    "Ã­"                  = "í"
    "Ãº"                  = "ú"
    "Ã±"                  = "ñ"
    "â¬"                 = "⬆️"
}

#cometario
# Define color class replacements (Tailwind to brand utilities)
$colorReplacements = @{
    "bg-blue-600"         = "bg-church-accent"
    "bg-blue-700"         = "bg-church-accent hover:opacity-90"
    "bg-indigo-600"       = "bg-church-accent"
    "bg-indigo-500"       = "bg-church-primary"
    "bg-indigo-700"       = "bg-church-primary hover:opacity-90"
    "text-indigo-600"     = "text-white"
    "border-indigo-500"   = "border-church-primary"
    "text-blue-800"       = "text-church-primary"
    "bg-indigo-600"       = "bg-church-accent"
    "hover:bg-indigo-700" = "hover:opacity-90"
}

function Replace-InFile($filePath) {
    $content = Get-Content -Path $filePath -Raw -Encoding UTF8
    $original = $content
    foreach ($kv in $replacements.GetEnumerator()) {
        $content = $content -replace [regex]::Escape($kv.Key), $kv.Value
    }
    foreach ($kv in $colorReplacements.GetEnumerator()) {
        $content = $content -replace [regex]::Escape($kv.Key), $kv.Value
    }
    if ($content -ne $original) {
        Set-Content -Path $filePath -Value $content -Encoding UTF8 -NoNewline
        Write-Host "Updated $filePath"
    }
}

# Process PHP and Blade files
Get-ChildItem -Path $projectRoot -Recurse -Include *.php, *.blade.php -File | ForEach-Object { Replace-InFile $_.FullName }

<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($website as $key => $site)
        <url>
            <loc>https://www.anandlab.com/{{ $site }}</loc>
        </url>
    @endforeach
    @foreach ($test_packages as $key =>  $row)
        <url>
            <loc>https://www.anandlab.com/{{ $row->IsPackage =='Yes' ? 'package' : 'test' }}/{{ $row->TestSlug }}</loc>
            <lastmod>{{ $row->created_at->tz('UTC')->toAtomString() }}</lastmod>
        </url>
    @endforeach 
</urlset>
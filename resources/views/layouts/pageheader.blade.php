<div id="pageheader" class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>@yield('meta_title')</h1>
                <nav itemscope itemtype="https://schema.org/Breadcrumb" role="navigation">
                    <ul class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="{{route('front.index')}}"><span itemprop="name">Strona główna</span></a><meta itemprop="position" content="1" />
                        </li>
                        <li class="sep"></li>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

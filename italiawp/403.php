<?php get_header(); ?>

<div class="Grid">
    <div class="Grid-cell Grid-cell--center u-size10of12 u-sm-size8of12 u-md-size5of12 u-lg-size4of12">
        <div class="ErrorPage u-textCenter u-text-xxs u-text-md-xs u-text-lg-s">
            <h1 class="ErrorPage-title">403</h1>
            <h2 class="ErrorPage-subtitle">Accesso negato</h2>
            <p class="Prose u-margin-r-all">Non disponi delle autorizzazioni per accedere a questa pagina, <a href="javascript:history.back();" title="Torna alla pagina precedente">torna indietro</a> o utilizza il menu per continuare la navigazione.</p>
            <a class="Button Button--default u-margin-r-all" href="<?php echo esc_url(home_url('/')); ?>">Torna alla Home</a>
        </div>

    </div>
</div>

<?php get_footer();

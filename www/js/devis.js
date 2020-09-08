"use strict";

// ****** VARIABLE *********************************

var domElements ={};


// ******************* Affiche/cache les parties de formulaires concernant des piéces selon les choix de l'utlisateur dans checkbox **************************************  

function onSpaceRadioChange()
{
    
    var allSpaces = [];

    $.each($("input[name='space']:checked"), function(){

        allSpaces.push($(this).val());

    });

    if (allSpaces.length > 0) {
        $('input[type=submit]').removeClass("hide"); 
    }

    else {
        $('input[type=submit]').addClass("hide"); 
    }
    

    if (allSpaces.includes('salle-de-baine')) {
        domElements.sdb.removeClass("hide");
    }

    else {
        domElements.sdb.addClass("hide");
    }

    if (allSpaces.includes('cuisine')) {
        domElements.cuisine.removeClass("hide");
    }

    else {
        domElements.cuisine.addClass("hide");
    }

    if (allSpaces.includes('pieces-de-vie')) {
        domElements.pdv.removeClass("hide");
    }

    else {
        domElements.pdv.addClass("hide");
    }
}

// ***************** assigne le nombre de m2 dépendant du choix de l'utilisateur dans le input type range  ***********************************************

function onRageChangeSurface ()
{
    domElements.form.find("[data-counter]").each(function ()
    {
        let rangeValue = $(this).find("input[type=range]").val();
        $(this).find(".range-input").val(rangeValue);
        $(this).find(".counter").html(rangeValue);
    });
}

// ***************** afficher/cacher des parties de formulaire selon les choix de l'utiisateur dans le radio button  ***********************************************

function onRadioChangeShow ()
{
    domElements.form.find(".what-renovate").each(function ()
    {

        let radioValue = $(this).find("input[type=radio]:checked").val();
        if (radioValue == 1)
        {
            $(this).find("fieldset").removeClass("hide");
            $(this).find("fieldset").removeAttr('disabled', 'disabled')

        }

        else if (radioValue == 0)
        {
            $(this).find("fieldset").addClass("hide");
            $(this).find("fieldset").attr('disabled', 'disabled');
        }
    });
}


// ******************* afficher/cacher select input (modifier l'installation électrique) *********************************************

function onSelectShow()
{
    if (domElements.electriqueCheckbox.is(':checked'))
    {
        domElements.quantitySelect.removeClass("hide");
    }
    if (!domElements.electriqueCheckbox.is(':checked'))
    {
        domElements.quantitySelect.addClass("hide");
    }
}

function onSecondSelectShow()
{
    if (domElements.electriqueCheckboxSecond.is(':checked'))
    {
        domElements.quantitySelectSecond.removeClass("hide");
    }
    else
    {
        domElements.quantitySelectSecond.addClass("hide");
    }

}

function onThirdSelectShow()
{
    if (domElements.electriqueCheckboxThird.checked = true)
    {
        domElements.quantitySelectThird.val("1");
    }
}


    $(function () {



//********   Chargement des éléments du DOM   ******************************

        domElements.form =  $("form");
        domElements.sdb = $('#sdb-form');
        domElements.cuisine = $('#cuisine-form');
        domElements.pdv = $('#pdv-form');

        domElements.spaceChoose = $('.space-choosing');
        domElements.range = $('input[type=range]');
        domElements.showHideRadio = $('.show-hide-radio')

        domElements.electriqueCheckbox = $('.checkbox18');
        domElements.quantitySelect = $('#select18');
        domElements.electriqueCheckboxSecond = $('.checkbox19');
        domElements.quantitySelectSecond = $('#select19');
        domElements.electriqueCheckboxThird = $('.checkbox20');
        domElements.quantitySelectThird = $('#checkbox20');
       
// ******************* ÉCOUTE DES ÉVÉNEMENTS ******************************

      
        domElements.spaceChoose.on('change', onSpaceRadioChange);
        domElements.electriqueCheckbox.on('change', onSelectShow);
        domElements.electriqueCheckboxSecond.on('change', onSecondSelectShow);
        domElements.electriqueCheckboxThird.on('change', onThirdSelectShow);
        domElements.range.on('input', onRageChangeSurface);
        domElements.showHideRadio.on('change', onRadioChangeShow);
        
    });















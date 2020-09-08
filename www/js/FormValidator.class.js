
'use strict';

var domElements = {};

function FormValidator(form) {

    this.form = form;

// Créer le tableau pour stocker les  messages d'erreur
    this.allErrors = [];
}


// Chercher les éléments de DOM avec l'attribute "data-required". Verifier si chaque element contient value. Si element n'a pas le value ajoute le  message d'erreur au tableau

FormValidator.prototype.checkRequired = function()
{
    let classThis = this ;
    this.form.find("[data-required]").each(function ()
    {
        let  value = $(this).val().trim();
        if (value == "")
        {
            classThis.allErrors.push({
                domElement : $(this),
                message : "Veuillez remplir ce champs",
            }) ;
        }
    });
}

// Chercher les elements de DOM avec l'attribute "data-minlength". Verifier si le value saisie par utilisateur a la longueur minimale definie dans l'attribute "minlength. 
// Sinon, comparer la longueur attendue avec la longueur réelle et ajouter le message avec le nombre de caractères manquants au tableau. 

FormValidator.prototype.checkMinLength = function()
{
    let classThis = this ;
    this.form.find("[data-minlength]").each(function ()
    {
        let  value = $(this).val().trim();
        let minLength = $(this).data("minlength") ;
        let missingChars = minLength - value.length ;

        if (value.length < minLength)
        {
            let message = "Veuillez entrer au moins "+minLength+" caractères<br>" ;
            message += "("+missingChars+" caractères manquants)" ;
            classThis.allErrors.push({
                domElement : $(this),
                message : message,
            }) ;
        }
    });
}

// Chercher les elements de DOM avec l'attribute "data-email". Verifier si le value saisie par utilisateur a le format defini
// Sinon, ajouter le message dedié au tableau. 

FormValidator.prototype.checkEmail = function()
{
    let classThis = this ;
    this.form.find("[data-email]").each(function ()
    {
        let  value = $(this).val().trim();

        if (! value.match(/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i ))
        {
            classThis.allErrors.push({
                domElement : $(this),
                message : "Veuillez entrer un email valide",
            }) ;
        }
    });
}


// Chercher les elements de DOM avec l'attribute "data-minchecked". Verifier si dans le champ de type checkbox le nombre des options cochées est plus grand 
// que le minimum defini dans l'attribute minchecked. Sinon, ajouter le message dedié au tableau.

FormValidator.prototype.checkMinChecked = function()
{
    let classThis = this ;
    this.form.find("[data-minchecked]").each(function ()
    {
        let minChecked = $(this).data("minchecked") ;

        let allchecked = $(this).find("input[type=checkbox]:checked") ;

        if (allchecked.length < minChecked)
        {
            classThis.allErrors.push({
                domElement : $(this),
                message : "Veuillez cocher au moins "+minChecked+" cases.",
            }) ;
        }
    });
}


// Chercher les elements de DOM avec l'attribute "data-equal". Verifier si le value saisie par utilisateur est le meme que value saisie dans le champ ayant l'attribute "data-equalcopy"
// Sinon, ajouter le message dedié au tableau. 


FormValidator.prototype.checkEqualFields = function()
{
    let classThis = this ;
    this.form.find("[data-equal]").each(function ()
    {
        let value = $(this).val() ;
        let otherEqualFields = $("[data-equalcopy="+$(this).data("equal")+"]") ;
        let error = false ;
        otherEqualFields.each(function()
        {
            error = error || ($(this).val() != value) ;
        }) ;

        if (error)
        {
            classThis.allErrors.push({
                domElement : $(this),
                message : "Ces champs doivent avoir la même valeur",
            }) ;
        }
    });

}

FormValidator.prototype.checkDataType = function()
{
    let classThis = this ;
    this.form.find("[data-type]").each(function ()
    {
        let  value = $(this).val().trim();
        let type = $(this).data("type");
        let optional = $(this).data("optional") ;
        switch (type)
        {
            case "float":
                if ((optional && isNaN(value)) ||  (value=="" || isNaN(value)))
                {
                    classThis.allErrors.push({
                        domElement : $(this),
                        message : "Veuillez enter un nombre",
                    }) ;
                }
                break;

            case "integer":
                if ((optional && (isNaN(value) || value % 1 != 0)) || (value == "" || isNaN(value) || value % 1 != 0))
                {
                    classThis.allErrors.push({
                        domElement : $(this),
                        message : "Veuillez enter un nombre entier",
                    }) ;
                }
                break;
        }

    });
}



FormValidator.prototype.checkRequiredSelect = function()
{
    let classThis = this ;

    this.form.find("[data-requiredselect]").each(function ()
    {
        let  value = $(this).val();
        let forbiddenValue = $(this).data("requiredselect") ;

        if (value == forbiddenValue)
        {
            classThis.allErrors.push({
                domElement : $(this),
                message : "Veuillez choisir une valeur",
            }) ;
        }
    });
}


// Pour chaque element de tableau creer et ajouter à DOM div avec un message d'erreur

FormValidator.prototype.displayAllErrors = function()
{
    if (this.allErrors.length > 0)
    {
        this.allErrors.forEach(function (error) {
            let errorDiv = $("<div>");
            errorDiv.addClass("form-error");
            errorDiv.html(error.message);
            error.domElement.before(errorDiv);

        })
    }
}


// En appuyant le bouton submit on appele les fonctions pour valider les champs saisis par l' utilisateur
FormValidator.prototype.onSubmit = function(event)
{
    // vider le tableau de vieux messages 
    
    this.allErrors = [];
    $(".form-error").remove();

    this.checkRequired();
    this.checkMinLength();
    this.checkEmail();
    this.checkEqualFields();
    this.checkDataType(); 
    this.checkMinChecked(); 
    this.checkRequiredSelect(); 
    this.displayAllErrors();
    

// empecher d'envoyer le formulaire, si le tableau contient l'element
    if (this.allErrors.length>0)
    {
        event.preventDefault();
    }

}



$(function () {

    let formVal = new FormValidator($("form[data-validate]"));
    formVal.form.on("submit", formVal.onSubmit.bind(formVal));

});


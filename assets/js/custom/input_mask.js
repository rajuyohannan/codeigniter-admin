$(function () {
	//Phone number
 	$("#contact, #clientPhone").inputmask("mask", {"mask": "(999) 999-9999"});
 	
 	//Name
 	$("#name, #clientName").inputmask("mask", {"mask": "a{5,25} a{5,25} a{5,25}"});

 	//Instant Messenger
 	$("#clientIm").inputmask("mask", {"mask": "a{5,25}:a{5,25}"});

 	//Client Email
 	$("#clientEmail").inputmask("mask", {
 		"mask": "*{1,50}[.*{1,50}][.*{1,50}][.*{1,50}]@*{1,50}[.*{2,6}][.*{1,2}]",
 		 greedy: false,
        onBeforePaste: function (pastedValue, opts) {
            pastedValue = pastedValue.toLowerCase();
            return pastedValue.replace("mailto:", "");
        },
        definitions: {
            '*': {
                validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                cardinality: 1,
                casing: "lower"
            }
        }
 	});
});
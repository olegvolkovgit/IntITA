//replace space symbols for json
angular.module('interpreterJsonFilter', [])
    .filter('interpreterJsonFilter', function(){
        return function(input){
            var oldSymbol = ['\n','\t','\r','\b','\f'];
            var newSymbol = ['\\n','\\t','\\r','\\b','\\f'];
            for (var i in oldSymbol) {
                input=input.replace( RegExp( oldSymbol[i], "g" ), newSymbol[i]);
            }
            input=JSON.parse(input);

            return input;
        }
    })
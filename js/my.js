/**
 * Created by Administrator on 2016/2/20.
 */
$(document).on('pagecreate',function(ecent){
    var page=event.target;
    var scope=$(page).scope();
    $(page).injector().invoke(function($complie){
        $complie(page)(scope);
        scope.$digest();
    })

})

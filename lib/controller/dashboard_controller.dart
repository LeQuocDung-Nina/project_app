import 'package:get/get.dart';

class Dashboardcontroller extends GetxController{

   var tabInex = 0;

   void updateIndex(int index){
     tabInex = index;
     update();
   }


}
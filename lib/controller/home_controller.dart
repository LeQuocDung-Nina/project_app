
import 'package:dio/dio.dart';
import 'package:get/get.dart';

import '../const.dart';



class HomeController extends GetxController{
  var procuctList;

  @override
  void onInit() {
    getProducts();
    super.onInit();
  }

  void getProducts() async{
    try{
      var response  = await Dio().get(baseUrl);
 
      if(response.statusCode == 200){
        procuctList = response.data["date"] as List;
      }
      

      
    } catch(e){
      print(e);
    }

  }
}
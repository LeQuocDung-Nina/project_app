
import 'package:demo1/controller/dashboard_controller.dart';
import 'package:demo1/controller/home_controller.dart';
import 'package:get/get.dart';


class DashboardBinding extends Bindings{
  @override
  void dependencies() {
    Get.put(Dashboardcontroller());
    Get.put(HomeController());
  }
}
import 'package:demo1/navpages/dashboard_binding.dart';
import 'package:demo1/route/app_route.dart';
import 'package:get/get.dart';

import '../navpages/tabbar.dart';

class AppPage{
  static var list = [
    GetPage(
      name: AppRoute.dashboard,
      page: () => TabbarBottom(),
      binding: DashboardBinding()

    )
  ];
}
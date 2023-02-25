import 'package:demo1/controller/dashboard_controller.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

import '../account/account_screen.dart';
import '../constants.dart';
import '../home_screen.dart';
import '../homepages/home_pages_screen.dart';

class TabbarBottom extends StatelessWidget {
  const TabbarBottom({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return GetBuilder<Dashboardcontroller>(
      builder: (controller) => Scaffold(
          body: IndexedStack(
            index: controller.tabInex,
            children: [
              HomePagesScreen(),
              HomeCreen(),
              AccountScreen(),
              AccountScreen(),
            ],
          ),
          bottomNavigationBar: BottomNavigationBar(
            type: BottomNavigationBarType.fixed,
            onTap: (val) {
              controller.updateIndex(val);
            },
            currentIndex: controller.tabInex,
            selectedItemColor: priceColor,
            unselectedItemColor: bLtitle2Color,
            showUnselectedLabels: false,
            showSelectedLabels: false,
            elevation: 3,

            items: const [
              BottomNavigationBarItem(label: 'Home', icon: Icon(Icons.home)),
              BottomNavigationBarItem(label: 'Favourite', icon: Icon(Icons.favorite)),
              BottomNavigationBarItem(label: 'Notification', icon: Icon(Icons.notifications)),
              BottomNavigationBarItem(label: 'Account', icon: Icon(Icons.person_outline)),
            ],
          )
      ),
    );
  }
}


import 'package:flutter/material.dart';

import '../account/account_screen.dart';
import '../constants.dart';
import '../home_screen.dart';
import '../homepages/home_pages_screen.dart';

class TabbarBottom extends StatefulWidget {

  @override
  State<TabbarBottom> createState() => _TabbarBottomState();
}

class _TabbarBottomState extends State<TabbarBottom> {
  List pages = [
    HomePagesScreen(),
    HomeCreen(),
    AccountScreen(),
    AccountScreen(),
  ];

  int currentIndex = 0;

  void onTap(int index){
    setState(() {
      currentIndex = index;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: pages[currentIndex],
        bottomNavigationBar: BottomNavigationBar(
          type: BottomNavigationBarType.fixed,
          onTap: onTap,
          currentIndex: currentIndex,
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
    );
  }
}

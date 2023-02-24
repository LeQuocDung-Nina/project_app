import 'package:flutter/gestures.dart';
import 'package:flutter/material.dart';
import '../../constants.dart';
import '../categorie.dart';
import '../productlist.dart';
import 'slideshow.dart';
import 'package:getwidget/getwidget.dart';

class TabbarHome extends StatefulWidget {
  const TabbarHome({Key? key}) : super(key: key);

  @override
  State<TabbarHome> createState() => _TabbarHomeState();
}

class _TabbarHomeState extends State<TabbarHome> with SingleTickerProviderStateMixin {
  // late TabController _tabController;
  //
  // @override
  // void initState() {
  //   super.initState();
  //   _tabController = TabController(vsync: this, length: 2);
  // }
  //
  // @override
  // void dispose() {
  //   _tabController.dispose();
  //   super.dispose();
  // }

  int _currentIndex = 0;
  bool _isVisibleTab1 = true;
  bool _isVisibleTab2 = false;

  void _onTabChanged(int index) {
    setState(() {
      _currentIndex = index;
      _isVisibleTab1 = _currentIndex == 0;
      _isVisibleTab2 = _currentIndex == 1;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Column(

      children: [
        // TabBar(
        //   controller: _tabController,
        //   labelColor: priceColor,
        //   unselectedLabelColor: blackColor,
        //   indicatorColor: priceColor,
        //   tabs:const [
        //     Tab(
        //       child: Text(
        //         "Home",
        //       ),
        //     ),
        //     Tab(
        //       child: Text(
        //         "Categories",
        //       ),
        //     ),
        // ]),
        // Container(
        //   height: 1150,
        //   child: TabBarView(
        //     physics: NeverScrollableScrollPhysics(),
        //     controller: _tabController,
        //     children: <Widget>[
        //         Column(
        //           children: const [
        //             SlideShow(),
        //             ProductList(),
        //           ],
        //         ),
        //         Column(
        //           children: const [
        //             Categories(),
        //           ],
        //         ),
        //     ],
        //   ),
        // ),

        DefaultTabController(
          length: 2,
          child: TabBar(
            labelColor: backtitleColor,
            labelStyle: const TextStyle(
              fontSize: 15,
              fontWeight: FontWeight.w700,
              color: Colors.black,
            ),
            unselectedLabelColor: backtitleColor,
            indicator: const UnderlineTabIndicator(
              borderSide: BorderSide(
                width: 2.0,
                color: priceColor,
              ),
              borderRadius: BorderRadius.zero,
            ),
            onTap: (index) {
              setState(() {
                _onTabChanged(index);
              });
            },
            tabs: const [
              Tab(text: ' Home '),
              Tab(text: ' Categories '),
            ],
          ),
        ),
        IndexedStack(
          index: _currentIndex,
          children: [
            Visibility(
              visible: _isVisibleTab1,
              child: Column(
                children: const [
                  SlideShow(),
                  ProductList(),
                ],
              ),
            ),
            Visibility(
              visible: _isVisibleTab2,
              child: Column(
                children: const [
                  SizedBox(height: 15,),
                  Categories(),
                ],
              ),
            ),
          ],
        ),
      ],
    );
  }
}


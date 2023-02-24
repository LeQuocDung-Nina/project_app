import 'wedget/searchhome.dart';
import 'wedget/slogan.dart';
import 'package:flutter/material.dart';
import 'appbarhome.dart';
import 'wedget/tabbar.dart';

class HomePagesScreen extends StatelessWidget {
  const HomePagesScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: AppBarHome()
      ),
      body: SingleChildScrollView(
        // physics: const NeverScrollableScrollPhysics(),
        child: Container(
          padding: EdgeInsets.symmetric(horizontal: 15.0,vertical: 25.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.start,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: const [
              SloganPage(),
              SearchHome(),
              SizedBox(height: 15,),
              TabbarHome(),
            ],
          ),
        ),
      ),
    );
  }
}


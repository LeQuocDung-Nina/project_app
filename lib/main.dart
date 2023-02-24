
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'navpages/tabbar.dart';


void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Flutter Demo',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        useMaterial3: true,
        textTheme: GoogleFonts.robotoCondensedTextTheme(Theme.of(context).textTheme),
      ),
      home: TabbarBottom(),
    );
  }
}

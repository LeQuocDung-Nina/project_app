import 'package:flutter/material.dart';

import '../constants.dart';
import '../navpages/tabbar.dart';
import 'body_account.dart';

class AccountScreen extends StatefulWidget {
  const AccountScreen({Key? key}) : super(key: key);

  @override
  State<AccountScreen> createState() => _AccountScreenState();
}

class _AccountScreenState extends State<AccountScreen> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        centerTitle: true,
        title: const Text("Tài khoản",style: TextStyle(fontSize: 18,fontWeight: FontWeight.bold,color: bLtitleColor),),
      ),
      body: BodyAccount(),
      // bottomNavigationBar: TabbarBottom(),
    );
  }
}

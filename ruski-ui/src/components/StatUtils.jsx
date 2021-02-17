export function createStatDictionary() {
  var tmp = [];
  tmp.push(createStatDictionaryEntry("Shot", "shots"));
  tmp.push(createStatDictionaryEntry("Made Cup", "makes"));
  tmp.push(createStatDictionaryEntry("Guy", "ginobs"));
  tmp.push(createStatDictionaryEntry("Made Guy", "made_ginobs"));
  tmp.push(createStatDictionaryEntry("Vom", "voms"));
  tmp.push(createStatDictionaryEntry("Forced Vom", "forced_voms"));
  tmp.push(createStatDictionaryEntry("Redemption Shot", "redemption_shots"));
  tmp.push(
    createStatDictionaryEntry("Made Redemption Shot", "redemption_makes")
  );
  tmp.push(createStatDictionaryEntry("Forced OT", "forced_ots"));
  tmp.push(createStatDictionaryEntry("Defended Shot", "shots_defended"));
  tmp.push(createStatDictionaryEntry("Knocked Cup Over", "cups_knocked_over"));
  tmp.push(createStatDictionaryEntry("Splash Out", "splash_outs"));
  tmp.push(createStatDictionaryEntry("Trifecta", "trifectas"));
  tmp.push(createStatDictionaryEntry("Difecta", "difectas"));
  tmp.push(createStatDictionaryEntry("OT Shot", "ot_shots"));
  tmp.push(createStatDictionaryEntry("OT Made Shot", "ot_makes"));
  tmp.push(
    createStatDictionaryEntry(
      "One Cup On the Table Make",
      "one_cup_on_the_table_makes"
    )
  );
  tmp.push(
    createStatDictionaryEntry(
      "One Cup On the Table Shot",
      "one_cup_on_the_table_shots"
    )
  );
  tmp.push(createStatDictionaryEntry("Balls Back", "balls_back"));

  return tmp;
}

function createStatDictionaryEntry(display, db) {
  return { DisplayName: display, DBName: db, activated: false };
}

export function createViewableStatsDictionary(stats) {
  var tmp = createStatDictionary();
  tmp.push(
    createStatDictionaryEntry("Shooting Percentage", "shooting_percentage")
  );
  tmp.push(
    createStatDictionaryEntry(
      "Effective Shooting Percentage",
      "effective_shooting_percentage"
    )
  );
  tmp.push(
    createStatDictionaryEntry(
      "On Target Shooting Percentage",
      "on_target_shooting_percentage"
    )
  );
  tmp.push(
    createStatDictionaryEntry(
      "Ginob Shooting Percentage",
      "ginob_shooting_percentage"
    )
  );
  tmp.push(
    createStatDictionaryEntry(
      "Overtime Shooting Percentage",
      "overtime_shooting_percentage"
    )
  );

  return tmp;
}
